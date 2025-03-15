@extends('layouts.app')
@section('styles')
    <style>
        main {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            padding: 2rem;
            background-color: #FCEBDC;
            min-height: calc(100vh - 4rem);
            max-width: 1920px;
            margin: 0 auto;
        }

        /* Sidebar Styling */
        .past-conversations {
            /* background: rgba(255, 255, 255, 0.8); */
            backdrop-filter: blur(8px);
            padding: 1.5rem;
            border-radius: 1rem;
            height: fit-content;
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
            gap: 0.75rem;
        }

        .conversations-list li {
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Message Styling */
        .message {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-radius: 1rem;
            max-width: 80%;
            animation: slideIn 0.3s ease;
        }

        .user-message {
            margin-left: auto;
            border: 1px solid #81AD74;

            color: #81AD74;
            box-shadow: 0 2px 4px #81AD74;
        }

        .ai-message {
            margin-right: auto;
            background: #81AD74;
            color: #fff;
            border: 1px solid #81AD74;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

        .message-text {
            line-height: 1.6;
            font-size: 1rem;
        }

        .message-time {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-top: 0.5rem;
        }

        /* Input Area Styling */
        .message-input-container {
            margin-top: auto;
            display: flex;
            gap: 1rem;
            padding: 1rem;
            position: sticky;
            background: #FCEBDC;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);

        }

        .message-input-container textarea {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid #81AD74;
            border-radius: 0.5rem;
            resize: none;
            font-size: 1rem;
            line-height: 1.5;
            min-height: 2.5rem;
            max-height: 10rem;
            transition: all 0.3s ease;
        }

        .message-input-container textarea:focus {
            outline: none;
            border-color: #5E875E;
            box-shadow: 0 0 0 3px rgba(94, 135, 94, 0.1);
        }

        .send-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #5E875E;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .send-button:hover {
            background: #4a6b4a;
            transform: translateY(-1px);
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
    </style>
@endsection

@section('content')
    <main>
        <div class="past-conversations">
            <h3>Previous Conversations</h3>
            <div class="conversations-list">
                <li>New Conversation</li>
                <li>Anxiety & Stress</li>
                <li>Depression</li>
                <li>Sleep Issues</li>
                <li>Relationship Advice</li>
            </div>
        </div>

        <div class="chat-area">
            <!-- Messages will appear here -->

            <div class="message ai-message">

                <div class="message-content">
                    <div class="message-text">Hello! How can I help you today?</div>
                    <div class="message-time">12:00 PM</div>
                </div>
            </div>

            <div class="message-input-container">
                <textarea placeholder="Type your message here..." rows="1"></textarea>
                <button class="send-button">
                    <i class="fas fa-paper-plane"></i>
                    <span>Send</span>
                </button>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea');

            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>
@endsection
