@php
    $setting = App\Models\Setting::find(1);
    $user = Illuminate\Support\Facades\Auth::user();
@endphp
<!doctype html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8" />
        <title>{{ $setting->name }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
        <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern" />
        <meta name="author" content="Shreethemes" />
        <meta name="email" content="support@shreethemes.in" />
        <meta name="website" content="https://shreethemes.in" />
        <meta name="Version" content="v4.2.0" />

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('storage/settings/' . $setting->favicon ) }}" />

        <!-- Css -->
        <link href="{{ asset('frontend') }}/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
        <!-- Bootstrap Css -->
        <link href="{{ asset('frontend') }}/css/bootstrap.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('frontend') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
        <!-- Style Css-->
        <link href="{{ asset('frontend') }}/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css" />
        @yield('css')
    </head>

    <body>
        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
        <!-- Loader -->

        @include('layouts.frontend.navbar')

        @yield('content')

        @include('layouts.frontend.footer')

        <div class="icons-wrapper">
            @if (Auth::check())
            @php
                $count = App\Models\Chat::where('recipient_id', $user->id)
                    ->where('status', 'unread')
                    ->whereHas('sender', function ($query) use ($user) {
                        $query->where('id', '!=', $user->id);
                    })
                    ->orderBy('created_at', 'ASC')
                    ->get()
                    ->count();
            @endphp
            @if ($count > 0)
            {{-- <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger">{{ $count }}</span> --}}
            @endif
            <a href="#" id="chat-icon" class="chat-icon fs-5" data-bs-toggle="modal" data-bs-target="#chatModal"><i data-feather="message-circle" class="fea icon-sm icons align-middle"></i></a>
            @endif
            <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5"><i data-feather="arrow-up" class="fea icon-sm icons align-middle"></i></a>
        </div>

        @include('frontend.chat.index')

        <!-- Javascript -->
        <!-- JAVASCRIPT -->
        <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
        <script src="{{ asset('frontend') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('frontend') }}/libs/feather-icons/feather.min.js"></script>
        <!-- SLIDER -->
        <script src="{{ asset('frontend') }}/libs/tiny-slider/min/tiny-slider.js"></script>
        @yield('javascript')
        @yield('javascript-chat')
        <!-- Main Js -->
        <script src="{{ asset('frontend') }}/js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
        <script src="{{ asset('frontend') }}/js/app.js"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
    </body>
</html>
