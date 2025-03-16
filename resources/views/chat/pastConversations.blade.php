  @auth
      <div class="past-conversations" class="">
          <h3>Previous Conversations</h3>
          <ul class="conversations-list-new">

              <li class="new-room">New Chat</li>
            </ul>
          <ul class="conversations-list">
              @foreach ($roomChats as $chat)
                  <li class="old-room" data-id="{{ $chat->id }}">{{ $chat->room_name }}</li>
              @endforeach
          </ul>
      </div>
  @else
      <div class="past-conversations-not-auth"></div>
  @endauth
