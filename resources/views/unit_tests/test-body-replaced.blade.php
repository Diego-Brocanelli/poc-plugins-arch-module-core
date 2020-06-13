@core_extends('core::unit_tests.test-document')
@section('body') <body id="replaced" name="{{ $name ?? '' }}">@yield('content')</body> @endsection