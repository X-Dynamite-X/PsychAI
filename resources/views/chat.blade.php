@extends('layouts.app')
@section('styles')
    <style>
        main {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            padding: 2rem;
            background-color: #FCEBDC;
            /* min-height: calc(100vh - 4rem); */
            max-width: 1920px;
            margin: 0 auto;
        }

        /* Sidebar Styling */
        .past-conversations {
            backdrop-filter: blur(8px);
            padding: 1.5rem;
            border-radius: 1rem;
            height: fit-content;
            max-height: 70vh;
            border: 1px solid #81AD74;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .past-conversations h3 {
            color: #2D3748;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #81AD74;
        }

        .conversations-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-height:47vh;
            height: fit-content

        }

        .conversations-list li {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            max-width: 90%;
            min-width: 90%;
            margin: 0.25rem 0;
            border: 1px solid #81AD74
        }

        .conversations-list li:hover {
            background: #81AD74;
            transform: translateX(4px);
        }




        /* Chat Area Styling */
        .chat-area {
            display: flex;
            flex-direction: column;
            border-radius: 1rem;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            border: 1px solid #81AD74;
            max-width: 70vw;
            max-height: 70vh;
            box-shadow: none;
        }

        /* Message Styling */
        .message {
            display: flex;
            animation: slideIn 0.3s ease;
            padding: 12px;
            margin-bottom: 24px;
            font-weight: 400;
            font-style: normal;
            border-radius: 12px;
            line-height: 2;
            font-size: 14px;
            width: fit-content;
            max-width: 75%;
            margin: 0 2rem;
            margin-top: 12px;
        }

        .user-message {
            margin-left: auto;
            color: #81AD74;
            border: 2px solid #81AD74;
            box-shadow: none;
        }

        .ai-message {
            margin-right: auto;
            background: #81AD74;
            border: 1px solid #81AD74;
            color: #FBE9D6;
            border: none;
        }

        .message-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: #F7FAFC;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 0;
            margin: 0;
        }

        .message-text {
            line-height: 1.6;
            font-size: 1rem;
        }

        .message-time {
            margin-top: 0.5rem;
            font-size: 12px;
            opacity: .7;
        }

        /* Input Area Styling */
        .message-input-container {
            margin-top: auto;
            display: flex;
            padding: 1rem;
            position: sticky;
            background: #FCEBDC;
            border-radius: 1rem;
            gap: 12px;
        }

        .message-input-container::placeholder {
            color: #A4ACC8;
            font-weight: 400;
            font-style: normal;
        }

        .message-input-container textarea {
            flex: 1;
            border-radius: 0.5rem;
            resize: none;
            font-size: 1rem;
            line-height: 1.5;
            min-height: 2.5rem;
            max-height: 10rem;
            transition: all 0.3s ease;
            font-size: 12px;
            color: #4C4868;
            padding: 12px;
            border: 2px solid #81AD74;
            background: #F6F6F6;
        }

        .message-input-container textarea:focus {
            outline: none;
            border-color: #81AD74;
            box-shadow: 0 0 0 3px rgba(94, 135, 94, 0.1);
        }

        .send-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #81AD74;
            color: #FBE9D6;
        }

        .send-button:hover {
            background: #4A6B4A;
            transform: translateY(-1px);
            border: 1px solid #81AD74;
            color: #81AD74;
        }

        .send-button:active {
            transform: translateY(1px);
        }

        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            gap: 0.25rem;
            padding: 0.5rem;
        }

        .typing-indicator span {
            width: 0.5rem;
            height: 0.5rem;
            background: #5E875E;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out;
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-6px);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            main {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1rem;
            }

            .past-conversations {
                display: none;
            }

            .message {
                max-width: 90%;
            }

            .message-input-container {
                padding: 0.75rem;
            }

            .send-button {
                padding: 0.75rem 1rem;
            }
        }

        /* إضافة تنسيقات جديدة للعرض الأولي */
        .initial-chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            margin: 2rem 0;
        }

        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .options button {
            padding: 1rem 2rem;
            background: #81AD74;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .options button:hover {
            background: #5E875E;
            transform: translateY(-2px);
        }

        .chat-area {
            position: relative;
        }

        .messages-container {
            display: none;
        }

        .message-input-container {
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px;
        }

        .user-message message message-content * {
            text-align: start;
        }

        .ai-message message message-content * {
            text-align: end;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-6px);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            main {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1rem;
            }

            .past-conversations {
                display: none;
            }

            .message {
                max-width: 90%;
            }

            .message-input-container {
                padding: 0.75rem;
            }

            .send-button {
                padding: 0.75rem 1rem;
            }
        }

        /* إضافة تنسيقات جديدة للعرض الأولي */
        .initial-chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            margin: 2rem 0;
        }

        .options {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .options button {
            padding: 1rem 2rem;
            background: #81AD74;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .options button:hover {
            background: #5E875E;
            transform: translateY(-2px);
        }

        .chat-area {
            position: relative;
        }

        .messages-container {
            display: none;
        }

        .message-input-container {
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px;
        }

        .past-conversations-not-auth {
            backdrop-filter: blur(8px);
            /* padding: 1.5rem; */
            border-radius: 1rem;
            height: fit-content;
            /* border: 1px solid #81AD74; */
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); */
            transition: all 0.3s ease;
        }

        .new-room {
            background: #81AD74;
            color: white;

        }

        .new-room:hover {
            background: #5E875E;
            transform: translateY(-2px);
        }

        .conversations-list-new {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
     .conversations-list-new  li {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            /* background: rgba(255, 255, 255, 0.5); */
            border: 1px solid #81AD74
        }

        .conversations-list li:hover {
            background: #81AD74;
            transform: translateX(4px);
        }

        .app-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .app-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 5px;
        }

        .app-scroll::-webkit-scrollbar-thumb {
            background: #81AD74;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <main>
        @include('chat.newRoom')
    </main>
@endsection

@section('script')
    <script></script>
@endsection
