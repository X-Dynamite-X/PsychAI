<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomChat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return view("chat");
        }
        $roomChats = RoomChat::where('user_id', auth()->user()->id)->get();
        
        
        return view("chat", ['roomChats' => $roomChats]);
    }

 
    public function store(Request $request)
    {
        //
    }

 
 

 
}