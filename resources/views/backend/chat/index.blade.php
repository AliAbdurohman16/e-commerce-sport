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
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Pesan</li>
                </ul>
            </nav>
        </div>

        <div class="row g-2">
            <div class="col-xl-4 col-lg-5 col-md-5 col-12 mt-4">
                <div class="card border-0 rounded shadow">
                    <div class="text-center p-4 border-bottom">
                        @if (Auth::user()->image == 'default/user.png')
                            <img src="{{ asset(Auth::user()->image) }}" class="avatar avatar-md-md rounded-pill shadow" alt="avatar">
                        @else
                            <img src="{{ asset('storage/users/' . Auth::user()->image) }}" class="avatar avatar-md-md rounded-pill shadow" alt="avatar">
                        @endif
                        <h5 class="mt-3 mb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0"><small class="text-muted">{{ Auth::user()->hasRole('admin') ? 'Administrator' : 'Customer Service' }}</small></p>
                        <button type="button" class="btn btn-primary btn-sm new-chat"><i class="fa-solid fa-plus"></i> Obrolan baru</button>
                    </div>

                    <div class="container">
                        <div class="p-2 chat chat-list mt-2" id="list" data-simplebar style="height: 220px; max-height: 100%; overflow-y: auto;"></div>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-xl-8 col-lg-7 col-md-7 col-12 mt-4" id="chat-person">
                <p class="d-flex text-muted justify-content-center align-items-center" style="height: 100%;">Pilih pengguna untuk mulai mengobrol.</p>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div><!--end container-->

<div class="viewModal" style="display: none;"></div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        listChat();

        $('.new-chat').click(function() {
            $.ajax({
                url: "{{ route('chats.new') }}",
                dataType: "json",
                success: function(response) {
                    $('.viewModal').html(response.listUser).show();
                    $('#add-modal').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function listChat()
    {
        $.ajax({
            url: "{{ route('chats.list') }}",
            dataType: "json",
            success: function(response) {
                $('#list').html(response.listView);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function contentChat(userId) {
        $.ajax({
            url: "{{ route('chats.content', ':id') }}".replace(':id', userId),
            dataType: "json",
            success: function(response) {
                $('#chat-ul').html(response.content);

                // Scroll to the bottom of .content-chat
                var contentChat = $(".content-chat")[0];
                contentChat.scrollTop = contentChat.scrollHeight - contentChat.clientHeight;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function showUserInfo(userId, event) {
        event.preventDefault(); // Prevent default link behavior

        $('#add-modal').modal('hide');

        const url = "{{ route('chats.person', ':id') }}";
        const redirectUrl = url.replace(':id', userId);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', redirectUrl, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Get the chat-person element and update its content
                const chatPersonElement = document.getElementById("chat-person");
                chatPersonElement.innerHTML = xhr.responseText;

                contentChat(userId);

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

                            listChat()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                });
            }
        };

        xhr.send();
    }

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
                contentChat(recipient);

                $("#chat-message").val("");

                const chatLinks = document.querySelectorAll('.chat-list');
                chatLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-id') === recipient) {
                        link.classList.add('active');
                    }
                });

                listChat();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
@endsection
