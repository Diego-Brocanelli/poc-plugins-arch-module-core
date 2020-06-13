<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @foreach(front_styles() as $style)

        <link rel="stylesheet" href="{{ $style }}">
        @endforeach

        {{-- O script principal é carregado antes de todos os outros --}}
        <script src="{{ front_scripts()[0] }}"></script>

	    @stack('styles')
        
    </head>
    <body>

	    @yield('body')
        
        @foreach(front_scripts() as $index => $script)
            @if($index > 0)
            <script src="{{ $script }}"></script>
            @endif
        @endforeach

	    @stack('scripts')

    </body>
</html>
