import $ from "jquery";
$(document).ready(function () {
    const $messageInput = $(".message-input-container textarea");
    const $sendButton = $(".send-button");
    const $messagesContainer = $(".messages-container");
    const $initialChat = $(".initial-chat");
    const $topicButtons = $(".topic-btn");
    const $roomId = $("#room-id");

    // معالجة النقر على أزرار المواضيع
    $topicButtons.on("click", function () {
        const topic = $(this).text();
        $messageInput.val(
            `أنت طبيب نفسي متخصص في علاج ${topic}. أود أن أتحدث عن ${topic}.`
        );
        sendMessage();
    });

    // تغيير حجم مربع النص تلقائ
    $messageInput.on("input", function () {
        const maxHeight = 200;
        $(this).css("height", "auto");
        $(this).css("height", Math.min(this.scrollHeight, maxHeight) + "px");
    });

    // معالجة النقر على زر الإرسال
    $sendButton.on("click", sendMessage);

    // معالجة ضغط مفتاح الإدخال
    $messageInput.on("keypress", function (e) {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const message = $messageInput.val().trim();
        if (message) {
            // إخفاء المحادثة الأولية وإظهار حاوية الرسائل
            $initialChat.hide();
            $messagesContainer.show();

            addMessage(message, "user");
            showTypingIndicator();
            const roomId = $roomId.attr("data-room_id");
            const isNewRoom = roomId === "newRoom";

            $.ajax({
                url: `/chat`,
                type: "POST",
                data: {
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    room_id: roomId,
                    is_new_room: isNewRoom,
                },
                success: function (response) {
                    removeTypingIndicator();
                    if (response.success) {
                        addMessage(response.message, "ai");

                        // إذا كانت محادثة جديدة، قم بإضافتها إلى قائمة المحادثات
                        if (isNewRoom && response.room_id && response.room_name) {
                            const newRoomHtml = `
                                <li class="old-room" data-id="${response.room_id}">${response.room_name}</li>
                            `;

                            // تحديث room_id للمحادثة الحالية
                            $roomId.attr("data-room_id", response.room_id);

                            // إضافة المحادثة الجديدة إلى بداية قائمة المحادثات
                            $(".conversations-list").prepend(newRoomHtml);

                            // إعادة تفعيل الأحداث للمحادثة الجديدة
                            $(".old-room").first().on("click", function () {
                                const chatId = $(this).data("id");
                                $roomId.attr("data-room_id", chatId);
                                loadChatHistory(chatId);
                            });
                        }
                    }
                },
                error: function (xhr) {
                    removeTypingIndicator();
                    console.error(xhr.responseText);
                    addMessage("عذراً، حدث خطأ. يرجى المحاولة مرة أخرى.", "ai");
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
        const time = new Date().toLocaleTimeString("ar-SA", {
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

    // معالجة النقر على قائمة المحادثات
    $(".old-room").on("click", function () {
        const chatId = $(this).data("id");
        $roomId.attr("data-room_id", chatId);
        loadChatHistory(chatId);
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
                // $messageInput.attr("disabled", true);

            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    });

    // نقل الرسائل الموجودة إلى الحاوية الجديدة
    $(".chat-area .message")
        .not(".message-input-container")
        .appendTo($messagesContainer);

    // دالة مساعدة لتحميل سجل المحادثة
    function loadChatHistory(chatId) {
        $.ajax({
            url: `/chat/${chatId}`,
            type: "GET",
            success: function (response) {
                $(".initial-chat").hide();
                $(".messages-container").empty().show();
                $(".messages-container").html(response.message_html);
                scrollToBottom();
                // $messageInput.attr("disabled", false);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            },
        });
    }
});
