@include("chat.pastConversations")

  <div class="chat-area" id="room-id" data-room_id="newRoom">
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

      <div class="message-input-container">
          <textarea placeholder="I am experiencing..." rows="1"></textarea>
          <button class="send-button">
              <i class="fas fa-paper-plane"></i>
              <span>Send</span>
          </button>
      </div>
  </div>
