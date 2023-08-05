@foreach($chats as $chat)
                @if($chat->sender_id == Auth::id())
                    <li class="chat-right">
                        <div class="d-inline-block">
                            <div class="d-flex chat-type mb-3">
                                <div class="chat-msg" style="max-width: 500px;">
                                    <p class="msg text-white small shadow px-3 py-2 rounded mb-1 bg-primary">{{ $chat->message }}</p>
                                    <small class="text-muted msg-time"><i class="ti ti-clock me-1"></i>{{ $chat->created_at->locale('id')->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="d-inline-block">
                            <div class="d-flex chat-type mb-3">
                                <div class="chat-msg" style="max-width: 500px;">
                                    <p class="msg text-muted small shadow px-3 py-2 rounded mb-1">{{ $chat->message }}</p>
                                    <small class="text-muted msg-time"><i class="ti ti-clock me-1"></i>{{ $chat->created_at->locale('id')->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
