<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('gemini.api_key');
        $this->baseUrl = config('gemini.base_url') . $this->apiKey;

        $this->client = new Client([
            'timeout' => 30.0,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function index(Request $request)
    {
        $roomChats = auth()->check()
            ? RoomChat::where('user_id', auth()->id())->latest()->get()
            : collect();
        $newRoom = $request->input("new-room");
        if ($newRoom) {
            $newRoomHtml = view("chat.newRoom", compact('roomChats'))->render();
            return response()->json([
                'newRoomHtml' => $newRoomHtml,

            ]);
        }

        return view("chat", compact('roomChats'));
    }
    public function show(RoomChat $roomChat)
    {
        $messages = Message::where('room_chats_id', $roomChat->id)->get();
        $message_html = view("chat.message", ['messages' => $messages])->render();
        return response()->json(["message_html" => $message_html]);
    }

    public function store(Request $request)
    {
        try {
            $message = $request->input('message');
            if (empty($message)) {
                return $this->errorResponse('Message cannot be empty');
            }

             $userId = auth()->check() ? auth()->id() : session()->getId();

            // تحديد الغرفة أو استخدام guest للزوار
            if (auth()->check()) {
                if ($request->input('room_id') !== "newRoom") {
                    $roomChat = RoomChat::find($request->input('room_id'));
                    $newRoom = false;
                } else {
                    $roomChat = RoomChat::create([
                        'room_name' => $message,
                        'user_id' => auth()->id(),
                    ]);
                    $newRoom = true;
                }
                $roomId = $roomChat->id;
            } else {
                $roomId = 'guest';
                $newRoom = true;
            }

            // إرسال الرسالة إلى AI مع السياق
            $aiResponse = $this->requestDataInAi($message, $roomId, $userId  , $newRoom);

            // حفظ المحادثة حسب نوع المستخدم
            if (auth()->check()) {
                $roomChat->messages()->create([
                    'sender_id' => auth()->id(),
                    'message_text' => $message,
                    'reseve_text' => $aiResponse
                ]);
            } else {
                $this->cacheMessage($userId, $message, $aiResponse);
            }

            return response()->json([
                'success' => true,
                'message' => $aiResponse,

                "room_name" => $roomChat->room_name,
                "room_id" => $roomChat->id,

            ]);
        } catch (\Exception $e) {
            Log::error('Chat System Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->errorResponse('An unexpected error occurred');
        }
    }
    protected function requestDataInAi($message, $roomId, $userId , $newRoom)
    {
        $contents = [];

        // جلب المحادثات السابقة
        if (auth()->check()) {
            $previousMessages = Message::where('room_chats_id', $roomId)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->reverse();

            foreach ($previousMessages as $prevMessage) {
                $contents[] = [
                    'role' => 'user',
                    'parts' => [['text' => $prevMessage->message_text]]
                ];
                $contents[] = [
                    'role' => 'model',
                    'parts' => [['text' => $prevMessage->reseve_text]]
                ];
            }
        } else {
            $cachedMessages = $this->getCachedMessages($userId);
            foreach ($cachedMessages as $prevMessage) {
                $contents[] = [
                    'role' => 'user',
                    'parts' => [['text' => $prevMessage['user_message']]]
                ];
                $contents[] = [
                    'role' => 'model',
                    'parts' => [['text' => $prevMessage['ai_response']]]
                ];
            }
        }
        if ($newRoom) {
            $message = "أنت طبيب نفسي إكلينيكي متخصص في علاج القلق، الاكتئاب، الإرهاق، ومتلازمة المحتال. لديك خبرة تزيد عن 10 سنوات في هذا المجال. استخدم أسلوب العلاج السلوكي المعرفي (CBT) في إجاباتك. أجب بأسلوب احترافي ومختصر، مع التركيز على النقاط الأساسية. استخدم لغة واضحة ومناسبة للجمهور العام. قم بتنظيم الردود باستخدام الفقرات القصيرة والقوائم المرقمة عند الحاجة. قم في استخدام صيغة المذكر في اجاباتك. قم في الرد على الرسالة التالية: " . $message;
        }

        // إضافة الرسالة الحالية
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $message]] // ✅ تم تصحيح الخطأ
        ];

        // إرسال الطلب إلى Gemini API
        $response = $this->client->post($this->baseUrl, [
            'query' => ['key' => $this->apiKey],
            'json' => [
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => 0.3,
                    'topK' => 5,
                    'topP' => 0.3,
                    'maxOutputTokens' => 150,
                ]
            ]
        ]);


        $responseData = json_decode($response->getBody(), true);

        if (empty($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            // throw new \Exception('Invalid response from AI');
        }

        return $responseData['candidates'][0]['content']['parts'][0]['text'];
    }
    protected function cacheMessage($userId, $userMessage, $aiResponse)
    {
        $messages = $this->getCachedMessages($userId);
        // حفظ آخر 5 رسائل فقط
        if (count($messages) >= 5) {
            array_shift($messages);
        }
        $messages[] = [
            'user_message' => $userMessage,
            'ai_response' => $aiResponse
        ];
        Cache::put('chat_history_' . $userId, $messages, now()->addMinutes(30));
    }

    protected function getCachedMessages($userId)
    {
        return Cache::get('chat_history_' . $userId, []);
    }
    protected function errorResponse($message, $code = 500)
    {

        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}