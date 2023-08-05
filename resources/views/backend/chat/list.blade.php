@foreach ($latestChats as $list)
    @if ($list->sender_id == Auth::id())
        <a href="{{ route('chats.person', $list->recipient_id) }}" class="d-flex chat-list p-2 mt-2 rounded position-relative" data-id="{{ $list->recipient_id }}" onclick="showUserInfo('{{ $list->recipient_id }}', event)">
            <div class="position-relative">
                @if ($list->recipient->image == 'default/user.png')
                    <img src="{{ asset($list->recipient->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                @else
                    <img src="{{ asset('storage/users/' . $list->recipient->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                @endif
                <i class="mdi mdi-checkbox-blank-circle {{ $list->recipient->is_online == 1 ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i>
            </div>
            <div class="overflow-hidden flex-1 ms-2">
                <div class="d-flex justify-content-between">
                    <h6 class="text-dark mb-0 d-block">{{ $list->recipient->name }}</h6>
    @else
        <a href="{{ route('chats.person', $list->sender_id) }}" class="d-flex chat-list p-2 mt-2 rounded position-relative" data-id="{{ $list->sender_id }}" onclick="showUserInfo('{{ $list->sender_id }}', event)">
            <div class="position-relative">
                @if ($list->sender->image == 'default/user.png')
                    <img src="{{ asset($list->sender->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                @else
                    <img src="{{ asset('storage/users/' . $list->sender->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                @endif
                <i class="mdi mdi-checkbox-blank-circle {{ $list->sender_id == Auth::id() ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i>
            </div>
            <div class="overflow-hidden flex-1 ms-2">
                <div class="d-flex justify-content-between">
                    <h6 class="text-dark mb-0 d-block">{{ $list->sender->name }}</h6>
    @endif
                    <small class="text-muted">{{ $list->created_at->locale('id')->diffForHumans(['short' => true, 'syntax' => false]) }}</small>
                </div>
                <div class="justify-content-between">
                    @php
                        if ($list->sender_id == Auth::id()) {
                            $count = 0;
                        } else {
                            $count = \App\Models\Chat::where('sender_id', $list->sender_id)
                                                    ->where('status', 'unread')
                                                    ->count();
                        }
                    @endphp
                    @if ($count > 0)
                        <span class="badge bg-soft-danger float-end">{{ $count }}</span>
                    @endif
                        <span class="{{ $count > 0 ? 'text-dark' : 'text-muted'}} h6 mb-0 text-truncate" data-id="{{ $list->sender_id }}">{{ $list->message }}</span>
                </div>
            </div>
        </a>
@endforeach
