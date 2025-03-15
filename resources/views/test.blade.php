@extends('layouts.app')
@section('styles')
    <style>
    main {
        display: flex;
        flex-direction: column;
        min-height: 80vh;
        padding: 20px;
    }

    .past-conversations button {
        background-color: #ddd;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    .messages-container {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        display: none;
    }

    .message {
        margin: 10px 0;
        padding: 10px;
        border-radius: 10px;
    }

    .user-message {
        background-color: #e3f2fd;
        margin-left: auto;
        max-width: 70%;
    }

    .ai-message {
        background-color: #f5f5f5;
        margin-right: auto;
        max-width: 70%;
    }

    .initial-chat {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1;
    }

    .input-area {
        width: 100%;
        padding: 20px;
        background: #fff;
        border-top: 1px solid #eee;
    }

    textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 10px;
        resize: none;
        min-height: 60px;
    }

    .options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }

    .options button {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .options button:hover {
        background-color: #e0e0e0;
    }
    </style>
@endsection

@section('content')
    <main>
        <div class="past-conversations">
            <button>Past Conversations</button>
        </div>

        <div class="chat-area">
            <div class="messages-container"></div>

            <div class="initial-chat">
                <h2>What would you like to talk about?</h2>
                <div class="options">
                    <button class="topic-btn">Anxiety</button>
                    <button class="topic-btn">Depression</button>
                    <button class="topic-btn">Burnout</button>
                    <button class="topic-btn">Impostor Syndrome</button>
                    <button class="topic-btn">More</button>
                </div>
            </div>

            <div class="input-area">
                <textarea placeholder="I am experiencing..."></textarea>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea');
            const initialChat = document.querySelector('.initial-chat');
            const messagesContainer = document.querySelector('.messages-container');
            const topicButtons = document.querySelectorAll('.topic-btn');

            // Auto-resize textarea
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });

            // Handle topic button clicks
            topicButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const topic = this.textContent;
                    textarea.value = `I would like to talk about ${topic}`;
                    sendMessage();
                });
            });

            // Handle textarea enter key
            textarea.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            function sendMessage() {
                const message = textarea.value.trim();
                if (message) {
                    // Hide initial chat view and show messages container
                    initialChat.style.display = 'none';
                    messagesContainer.style.display = 'block';

                    // Add user message
                    addMessage(message, 'user');

                    // Clear textarea
                    textarea.value = '';
                    textarea.style.height = 'auto';

                    // Simulate AI response (replace with actual API call)
                    setTimeout(() => {
                        addMessage('Thank you for sharing. How can I help you today?', 'ai');
                    }, 1000);
                }
            }

            function addMessage(text, type) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${type}-message`;
                messageDiv.textContent = text;
                messagesContainer.appendChild(messageDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        });
    </script>
@endsection
