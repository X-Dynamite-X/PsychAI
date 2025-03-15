import $ from "jquery";

$(document).ready(function () {
    const $messageInput = $(".message-input-container textarea");
    const $sendButton = $(".send-button");
    const $chatArea = $(".chat-area");
    const $messagesContainer = $("<div class='messages-container'></div>");

    // Add messages container before the input container
    $(".message-input-container").before($messagesContainer);

    // Auto-resize textarea
    $messageInput.on("input", function () {
        const maxHeight = 200;
        $(this).css("height", "auto");
        $(this).css("height", Math.min(this.scrollHeight, maxHeight) + "px");
    });

    // Handle send button click
    $sendButton.on("click", sendMessage);

    // Handle enter key press
    $messageInput.on("keypress", function(e) {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const message = $messageInput.val().trim();
        if (message) {
            addMessage(message, "user");
            showTypingIndicator();

            $.ajax({
                url: "/chat",
                type: "POST",
                data: {
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    removeTypingIndicator();
                    if (response.success) {
                        addMessage(response.message, "ai");
                    }
                },
                error: function (xhr) {
                    removeTypingIndicator();
                    console.error(xhr.responseText);
                    addMessage("عذراً، حدث خطأ ما. يرجى المحاولة مرة أخرى.", "ai");
                },
            });

            $messageInput.val("").css("height", "auto");
        }
    }

    function showTypingIndicator() {
        const typingHtml = `
            <div id="typing-indicator" class="message ai-message">
                <div class="message-content">
                    <div class="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        `;
        $messagesContainer.append(typingHtml);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        $("#typing-indicator").remove();
    }

    function addMessage(message, type) {
        const time = new Date().toLocaleTimeString("en-US", {
            hour: "2-digit",
            minute: "2-digit",
        });

        const messageHtml = `
            <div class="message ${type}-message">
                <div class="message-content">
                    <div class="message-text">${message}</div>
                    <div class="message-time">${time}</div>
                </div>
            </div>
        `;

        $messagesContainer.append(messageHtml);
        scrollToBottom();
    }

    function scrollToBottom() {
        $messagesContainer.scrollTop($messagesContainer[0].scrollHeight);
    }

    // Handle conversation list clicks
    $(".conversations-list li").on("click", function() {
        const topic = $(this).text();
        $messageInput.val(`Let's talk about ${topic}`);
        sendMessage();
    });

    // Move existing messages to the new container
    $(".chat-area .message").not(".message-input-container").appendTo($messagesContainer);
});
