<!-- Modal Add -->
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="p-2 chat chat-list" data-simplebar style="height: 350px; max-height: 100%; overflow-y: auto;">
                <div class="container">
                    @foreach ($users as $user)
                        <a href="{{ route('chats.person', $user->id) }}" class="d-flex chat-list p-2 mt-2 rounded position-relative" data-id="{{ $user->id }}" onclick="showUserInfo('{{ $user->id }}', event)">
                            <div class="position-relative">
                                @if ($user->image == 'default/user.png')
                                    <img src="{{ asset($user->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                @else
                                    <img src="{{ asset('storage/users/' . $user->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                @endif
                            </div>
                            <div class="overflow-hidden ms-2">
                                <h6 class="text-dark mt-2">{{ $user->name }}</h6>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add End -->
