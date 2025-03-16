<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

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

            $aiResponse = $this->requestDataInAi($message);

            if ($request->input('room_id') !== "newRoom" && auth()->check()) {
                $roomChat = RoomChat::find($request->input('room_id'));
            } else if (auth()->check()) {
                $roomChat = RoomChat::create([
                    'room_name' => $message,
                    'user_id' => auth()->id(),
                ]);
            }
            // Save chat if user is authenticated
            if (auth()->check()) {

                $roomChat->messages()->create([
                    'sender_id' => auth()->id(),
                    'message_text' => $message,
                    'reseve_text' => $aiResponse
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => $aiResponse
            ]);
        } catch (GuzzleException $e) {
            Log::error('Gemini API Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return $this->errorResponse('Failed to communicate with AI service: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Chat System Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->errorResponse('An unexpected error occurred');
        }
    }
    protected function requestDataInAi($message)
    {

        $response = $this->client->post($this->baseUrl, [
            'query' => ['key' => $this->apiKey],
            'json' => [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]
        ]);
        $responseData = json_decode($response->getBody(), true);

        if (empty($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            return $this->errorResponse('Invalid response from AI');
        }
        $aiResponse = $responseData['candidates'][0]['content']['parts'][0]['text'];

        return $aiResponse;
    }
    protected function errorResponse($message, $code = 500)
    {

        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}