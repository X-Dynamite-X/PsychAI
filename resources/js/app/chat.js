import $ from "jquery";

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("chat-form");
    const messagesContainer = document.getElementById("chat-messages");
    const textarea = form.querySelector("textarea");

    // Auto-resize textarea
    textarea.addEventListener("input", function () {
        this.style.height = "auto";
        this.style.height = this.scrollHeight + "px";
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const message = textarea.value.trim();
        if (message) {
            $.ajax({
                url: "/chat", // Replace with your actual route
                type: "POST",
                data: {
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success) {
                        addMessage(response.message, "ai");
                        textarea.value = "";
                        textarea.style.height = "60px";
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                },
            });

            // addMessage(message, "user");
            // textarea.value = "";
            // textarea.style.height = "60px";

            // Simulate AI response (replace with actual API call)
            // showTypingIndicator();
            // setTimeout(() => {
            //     removeTypingIndicator();
            //     addMessage(
            //         "شكراً لمشاركتك. كيف يمكنني مساعدتك بشكل أفضل؟",
            //         "ai"
            //     );
            // }, 1500);
        }
    });

    function showTypingIndicator() {
        const typingDiv = document.createElement("div");
        typingDiv.id = "typing-indicator";
        typingDiv.className =
            "flex items-start space-x-4 space-x-reverse max-w-3xl mx-auto mt-4";
        typingDiv.innerHTML = `
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                <i class="fas fa-robot text-white"></i>
            </div>
            <div class="flex-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 inline-flex gap-2">
                    <span class="animate-bounce">.</span>
                    <span class="animate-bounce delay-100">.</span>
                    <span class="animate-bounce delay-200">.</span>
                </div>
            </div>
        `;
        messagesContainer.appendChild(typingDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function removeTypingIndicator() {
        const typingIndicator = document.getElementById("typing-indicator");
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    function addMessage(message, type) {
        const time = new Date().toLocaleTimeString("ar-SA", {
            hour: "2-digit",
            minute: "2-digit",
        });
        const messageDiv = document.createElement("div");
        messageDiv.className = `flex items-start ${
            type === "user" ? "flex-row-reverse" : ""
        } space-x-4 space-x-reverse max-w-3xl mx-auto mt-4`;

        const gradientBg =
            type === "user"
                ? "from-emerald-500 to-emerald-600"
                : "from-blue-500 to-blue-600";
        const messageBg =
            type === "user"
                ? "bg-emerald-50 dark:bg-gray-700"
                : "bg-white dark:bg-gray-800";
        const icon = type === "user" ? "fa-user" : "fa-robot";

        messageDiv.innerHTML = `
            <div class="w-10 h-10 rounded-full bg-gradient-to-r ${gradientBg} flex items-center justify-center shadow-md">
                <i class="fas ${icon} text-white"></i>
            </div>
            <div class="flex-1">
                <div class="${messageBg} rounded-lg shadow-sm p-4">
                    <p class="text-gray-800 dark:text-white">${message}</p>
                </div>
                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400 ${
                    type === "user" ? "ml-2 text-left" : "mr-2"
                }">${time}</div>
            </div>
        `;

        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});
