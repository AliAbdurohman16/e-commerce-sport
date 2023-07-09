@extends('layouts.backend.main')

@section('title', 'Pesan')

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pesan</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('chats.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Personal</li>
                </ul>
            </nav>
        </div>

        <a href="{{ route('chats.index') }}" class="btn btn-warning btn-sm mt-2"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

        <div class="row g-2">
            <div class="col-xl-12 col-lg-7 col-md-7 col-12 mt-4">
                <div class="card chat chat-person border-0 shadow rounded">
                        <div class="d-flex justify-content-between align-items-center border-bottom p-4">
                            <div class="d-flex">
                                @if ($recipient->image == 'default/user.png')
                                    <img src="{{ asset($recipient->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                @else
                                    <img src="{{ asset('storage/users/' . $recipient->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                @endif
                                <div class="overflow-hidden ms-3">
                                    <a href="#" class="text-dark mb-0 h6 d-block text-truncate">{{ $recipient->name }}</a>
                                    <small class="text-muted"><i class="mdi mdi-checkbox-blank-circle {{ $recipient->id == Auth::id() ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i> {{ $recipient->id == Auth::id() ? 'Online' : 'Offline' }}</small>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0">
                                <li class="dropdown dropdown-primary list-inline-item">
                                    <button type="button" class="btn btn-icon btn-soft-primary dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu dd-menu dropdown-menu-end shadow border-0 mt-3 py-3">
                                        <span class="dropdown-item text-dark" id="delete-all"><span class="mb-0 d-inline-block me-1"><i class="ti ti-trash"></i></span> Delete</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    <ul class="p-4 list-unstyled mb-0 chat" id="chat-ul" data-simplebar style="height: 290px; max-height: 100%; overflow-y: auto;">
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
                    </ul>

                    <div class="p-2 rounded-bottom shadow">
                        <div class="row g-2">
                            <div class="col">
                                <input type="hidden" id="recipient" value="{{ $recipient->id }}">
                                <input type="text" class="form-control border" id="chat-message" style="height: 36px;" placeholder="Tuliskan Pesan...">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-icon btn-primary" id="send-message"><i class="ti ti-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        var chat = $("#chat-ul");
        chat.scrollTop(chat[0].scrollHeight);

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
            var recipient = document.getElementById("recipient").value;

            $.ajax({
                url: "{{ route('chats.send') }}",
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    recipient: recipient,
                    message: message,
                },
                dataType: "json",
                success: function(response) {
                    var chat = $("#chat-ul");
                    var html = '<li class="chat-right"><div class="d-inline-block"><div class="d-flex chat-type mb-3"><div class="chat-msg" style="max-width: 500px;"><p class="msg text-white small shadow px-3 py-2 rounded mb-1 bg-primary">' + message + '</p><small class="text-muted msg-time"><i class="ti ti-clock me-1"></i>Baru saja</small></div></div></div></li>';
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
            var recipient = document.getElementById("recipient").value;

            $.ajax({
                url: "{{ route('chats.delete-all') }}",
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    sender_id: senderId,
                    recipient: recipient,
                },
                success: function(response) {
                    $('#chat-ul').empty();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.log(recipient);
                }
            });
        });
    });
</script>
@endsection
