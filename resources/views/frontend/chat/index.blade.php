@php
    use Illuminate\Support\Facades\Auth;
@endphp

@if (Auth::check())

<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    @php
        $user = Auth::user();
        if (Auth::check()) {
            $chats = App\Models\Chat::where('sender_id', $user->id)
                         ->orWhere('recipient_id', $user->id)
                         ->orderBy('created_at', 'ASC')
                         ->get();

        }
    @endphp
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <img src="{{ asset('frontend/images/logo.png') }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                    <div class="overflow-hidden ms-3">
                         <a href="#" class="text-dark mb-0 h6 d-block text-truncate">Rania Sport</a>
                        <small class="text-muted">
                            <i class="mdi mdi-checkbox-blank-circle {{ Auth::check() && Auth::user()->hasRole('admin') ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i>
                            {{ Auth::check() && Auth::user()->hasRole('admin') ? 'Online' : 'Offline' }}
                        </small>
                    </div>
                </div>

                <ul class="list-unstyled mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-icon" id="delete-all"><i class="uil uil-trash fs-4 text-dark"></i></button>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                    </li>
                </ul>
            </div>
            <div class="col-xl-12 col-12 mt-4">
                <div class="chat chat-person rounded">
                    <ul class="p-4 list-unstyled mb-0 chat" id="chat-ul" data-simplebar style="height: 420px; max-height: 100%; overflow-y: auto;">
                        @foreach($chats as $chat)
                            @if($chat->sender_id == Auth::id())
                                <li class="chat-right">
                                    <div class="d-inline-block">
                                        <div class="d-flex chat-type mb-3">
                                            <div class="position-relative chat-user-image">
                                                {{-- @if (Auth::user()->image == 'default/user.png')
                                                    <img src="{{ asset(Auth::user()->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                                @else
                                                    <img src="{{ asset('storage/users/' . Auth::user()->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                                @endif --}}
                                                <i class="mdi mdi-checkbox-blank-circle {{ Auth::check() ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i>
                                            </div>

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
                                            {{-- <div class="position-relative">
                                                <img src="{{ asset('frontend/images/logo.png') }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                                                <i class="mdi mdi-checkbox-blank-circle {{ Auth::check() && Auth::user()->hasRole('admin') ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i>
                                            </div> --}}

                                            <div class="chat-msg" style="max-width: 500px;">
                                                <p class="msg text-muted small shadow px-3 py-2 rounded mb-1">{{ $chat->message }}</p>
                                                <small class="text-muted msg-time"><i class="ti ti-clock me-1"></i>{{ $chat->created_at->locale('id')->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="p-2 rounded-bottom shadow">
                        <div class="row g-2">
                            <div class="col">
                                <input type="text" class="form-control border" style="height: 36px;" id="chat-message" placeholder="Tuliskan Pesan..." required>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-icon btn-primary" id="send-message"><i class="uil uil-message"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript-chat')
<script>
    $(document).ready(function() {
        $('#chat-icon').click(function() {
            @php
                $user = Auth::user();
                if (Auth::check()) {
                    $reads = App\Models\Chat::where('recipient_id', $user->id)
                                ->where('status', 'unread')
                                ->whereHas('sender', function ($query) use ($user) {
                                    $query->where('id', '!=', $user->id);
                                })
                                ->orderBy('created_at', 'ASC')
                                ->get();

                    foreach ($reads as $read) {
                        $read->status = 'read';
                        $read->save();
                    }

                }
            @endphp
        });

        $('#chatModal').on('shown.bs.modal', function() {
            var chat = $("#chat-ul");
            chat.scrollTop(chat[0].scrollHeight);
        });

        $(document.body).on('keyup', '#chat-message', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                send();
            }
        });

        $('#send-message').click(function(event) {
            event.preventDefault();
            send();
        });

        function send() {
            var message = document.getElementById("chat-message").value;

            $.ajax({
                url: "{{ route('send') }}",
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    message: message,
                },
                dataType: "json",
                success: function(response) {
                    var chat = $("#chat-ul");
                    var html = '<li class="chat-right"><div class="d-inline-block"><div class="d-flex chat-type mb-3"><div class="position-relative chat-user-image"><img src="{{ asset(Auth::user()->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar"><i class="mdi mdi-checkbox-blank-circle text-success on-off align-text-bottom"></i></div><div class="chat-msg" style="max-width: 500px;"><p class="msg text-white small shadow px-3 py-2 rounded mb-1 bg-primary">' + message + '</p><small class="text-muted msg-time"><i class="ti ti-clock me-1"></i>Baru saja</small></div></div></div></li>';
                    chat.append(html);

                    chat.scrollTop(chat[0].scrollHeight);

                    $("#chat-message").val("");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


        $('#delete-all').click(function() {
            var senderId = $(this).data('sender-id');

            $.ajax({
                url: "{{ route('delete-all') }}",
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    sender_id: senderId,
                },
                success: function(response) {
                    $('#chat-ul').empty();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>
@endsection
@endif
