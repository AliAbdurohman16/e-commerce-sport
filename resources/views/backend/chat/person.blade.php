
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
                <small class="text-muted"><i class="mdi mdi-checkbox-blank-circle {{ $recipient->is_online == 1 ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i> {{ $recipient->is_online == 1 ? 'Online' : 'Offline' }}</small>
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

    <div class="content-chat">
        <ul class="p-4 list-unstyled chat" id="chat-ul" data-simplebar></ul>
    </div>

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
