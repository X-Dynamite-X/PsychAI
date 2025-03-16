import $ from "jquery";
$(document).ready(function () {
    const $messageInput = $(".message-input-container textarea");
    const $sendButton = $(".send-button");
    const $messagesContainer = $(".messages-container");
    const $initialChat = $(".initial-chat");
    const $topicButtons = $(".topic-btn");

    // Handle topic button clicks
    $topicButtons.on("click", function () {
        const topic = $(this).text();
        $messageInput.val(`I would like to talk about ${topic}`);
        sendMessage();
    });

    // Auto-resize textarea
    $messageInput.on("input", function () {
        const maxHeight = 200;
        $(this).css("height", "auto");
        $(this).css("height", Math.min(this.scrollHeight, maxHeight) + "px");
    });

    // Handle send button click
    $sendButton.on("click", sendMessage);

    // Handle enter key press
    $messageInput.on("keypress", function (e) {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const message = $messageInput.val().trim();
        if (message) {
            // Hide initial chat and show messages container
            $initialChat.hide();
            $messagesContainer.show();

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
                    addMessage(
                        "Sorry, an error occurred. Please try again.",
                        "ai"
                    );
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
    $(".old-room").on("click", function () {
        const chatId = $(this).data("id");
        $.ajax({
            url: `/chat/${chatId}`,
            type: "GET",
            success: function (response) {
                $(".initial-chat").hide();
                 $(".messages-container").empty().show();
                 $(".messages-container").html(response.message_html);
                scrollToBottom();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    });
    $(".new-room").on("click", function () {
        $.ajax({
            url: "/chat",
            type: "GET",
            data: {
                "new-room": true,
            },
            success: function (response) {
                $("main").empty();
                $("main").html(response.newRoomHtml);
                console.log("done");
                
                // $(".initial-chat").show();
                // $(".messages-container").empty().hide();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    });

    // Move existing messages to the new container
      $(".chat-area .message")
          .not(".message-input-container")
          .appendTo($messagesContainer);
});
