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
            <div class="col-xl-12 col-lg-5 col-md-5 col-12 mt-4">
                <div class="card border-0 rounded shadow">
                    <div class="container">
                        <div class="p-2 chat chat-list mt-2" data-simplebar style="height: 278px; max-height: 100%; overflow-y: auto;">
                            @foreach ($latestChats as $list)
                            @if ($list->sender_id == Auth::id())
                                <a href="{{ route('chats.person', $list->recipient_id) }}" class="d-flex chat-list p-2 mt-2 rounded position-relative">
                                    <div class="position-relative">
                                        @if ($list->recipient->image == 'default/user.png')
                                            <img src="{{ asset($list->recipient->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                        @else
                                            <img src="{{ asset('storage/users/' . $list->recipient->image) }}" class="avatar avatar-md-sm rounded-circle border shadow" alt="avatar">
                                        @endif
                                        <i class="mdi mdi-checkbox-blank-circle {{ $list->recipient_id == Auth::id() ? 'text-success' : 'text-danger' }} on-off align-text-bottom"></i>
                                    </div>
                                    <div class="overflow-hidden flex-1 ms-2">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-dark mb-0 d-block">{{ $list->recipient->name }}</h6>
                                            <small class="text-muted">{{ $list->created_at->locale('id')->diffForHumans(['short' => true, 'syntax' => false]) }}</small>
                                        </div>
                                        <div class="text-muted text-truncate">{{ $list->message }}</div>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('chats.person', $list->sender_id) }}" class="d-flex chat-list p-2 mt-2 rounded position-relative">
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
                                            <small class="text-muted">{{ $list->created_at->locale('id')->diffForHumans(['short' => true, 'syntax' => false]) }}</small>
                                        </div>
                                        <div class="text-muted text-truncate">{{ $list->message }}</div>
                                    </div>
                                </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div>
</div><!--end container-->
@endsection
