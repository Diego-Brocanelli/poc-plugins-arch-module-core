<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        {!! main_css() !!}
        {!! module_css() !!}
	    @stack('styles')
        
    </head>
    <body>

	    @yield('body')
        
        {!! main_js() !!}
        {!! module_js() !!}
	    @stack('scripts')

    </body>
</html>
