{{--
Este é um layout que aloca os componentes 
de forma que ocupem toda a janela do navegador.
--}}

@extendsTemplate('core::body')

@section('body-content')

@includeTemplate('core::layout.header')

<div class="container-fluid bg-light">

    <div class="row">
        <div class="align-self-stretch col-sm p-0 bg-secondary" style="flex: 0 0 260px;">
        @includeTemplate('core::layout.sidebar-left')
        </div>

        <div class="col-sm p-0">

            <main>
            @yield('main-area')
            </main>
        
        </div>

        {{--
        <div class="col-sm">
            includeTemplate('core::layout.right')
        </div>
        --}}

    </div>

</div>

@includeTemplate('core::layout.footer')

@endsection