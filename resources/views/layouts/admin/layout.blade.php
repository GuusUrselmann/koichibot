<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <script>
            function url() {
                return '{{ url('') }}';
            }
        </script>
        <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/behaviour_admin.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/tableControls.js') }}"></script>

        <link href="{{ asset('css/grid.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/layout_admin.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/admin_blocks.css') }}" rel="stylesheet" type="text/css" >

        <link href="{{ asset('fonts/ignis-sharp/css/font.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('fonts/fontawesome-free-5.3.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css" >
        @yield('stylesheets')
    </head>
    <body>
        <div class="modals">
            @if(isset(session('data')['modals']))
                @foreach(session('data')['modals'] as $modal)
                    <div class="modal" data-duration="{{$modal['duration']}}">
                        <div class="modal-title">
                            {{$modal['title']}}<span class="modal-remove"><i class="fa fas far fal fab fa-times"></i></span>
                        </div>
                        <div class="modal-message">
                            {!!$modal['message']!!}
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="page-wrapper">
            <header>
                @include('layouts.admin.header')
            </header>
            <main>
                @include('layouts.admin.sidebar')
                <div class="page-content" id="pageContent">
                    <div class="page-sections">
                        @yield('content')
                    </div>
                    <footer>
                        <div class="footer-content">
                        </div>
                        <div class="footer-copyright">
                        </div>
                    </footer>
                </div>
            </main>
        </div>
    </body>
</html>
