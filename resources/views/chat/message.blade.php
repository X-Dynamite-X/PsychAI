@foreach ($messages as $message)
    <div class="message user-message">
        <div class="message-content">
            <div class="message-text">{{ $message->message_text }}</div>
            <div class="message-time">{{ $message->created_at }}</div>
        </div>
    </div>
    <div class="message ai-message">
        <div class="message-content">
            <div class="message-text">{{ $message->reseve_text }}</div>
            <div class="message-time">{{ $message->created_at }}</div>
        </div>
    </div>
@endforeach
