<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomChat;
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
        $this->baseUrl = config('gemini.base_url').$this->apiKey;

        $this->client = new Client([
            'timeout'  => 30.0,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function index()
    {
        $roomChats = auth()->check()
            ? RoomChat::where('user_id', auth()->id())->latest()->get()
            : collect();

        return view("chat", compact('roomChats'));
    }

    public function store(Request $request)
    {
        try {
            $message = $request->input('message');

            if (empty($message)) {
                return $this->errorResponse('Message cannot be empty');
            }

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

            // Save chat if user is authenticated
            if (auth()->check()) {
                RoomChat::create([
                    'user_id' => auth()->id(),
                    'message' => $message,
                    'response' => $aiResponse
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

    protected function errorResponse($message, $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
}
