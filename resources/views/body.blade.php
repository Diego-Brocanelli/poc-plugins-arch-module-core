@extendsTemplate('core::document')

{{--
A view body.blade.php existe para que seja possível substituí-la através do Templates\Handler.
Existem temas que necessitam alterar a tag body, adicionando parâmetros nela
--}}

@section('body')<body class="bg-dark">
    @yield('body-content')

    @foreach(front_scripts_bottom() as $script)<script src="{{ $script }}"></script> @endforeach

    @stack('scripts')

    </body> 
@endsection