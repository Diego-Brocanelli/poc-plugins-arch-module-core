@core_extends('core::unit_tests.test-document')
@section('body') <body id="original" name="{{ $name ?? '' }}">@yield('content')</body> @endsection