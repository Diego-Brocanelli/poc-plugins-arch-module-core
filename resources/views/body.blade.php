@core_extends('core::document')
@section('body') 
<body id="original" name="{{ $name ?? '' }}">
    @yield('content')
</body> 
@endsection