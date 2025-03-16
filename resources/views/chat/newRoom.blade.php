@include("chat.pastConversations")

<div class="chat-area" id="room-id" data-room_id="{{ auth()->check() ? 'newRoom' : 'guest' }}">
    <div class="messages-container"></div>

    <div class="initial-chat">
        <h2>عن ماذا تريد أن نتحدث؟</h2>
        <div class="options">
            <button class="topic-btn">القلق</button>
            <button class="topic-btn">الاكتئاب</button>
            <button class="topic-btn">الإرهاق</button>
            <button class="topic-btn">متلازمة المحتال</button>
         </div>
    </div>

    <div class="message-input-container">
        <textarea placeholder="أشعر بـ..." rows="1"></textarea>
        <button class="send-button">
            <i class="fas fa-paper-plane"></i>
            <span>إرسال</span>
        </button>
    </div>
</div
