{{--
Este é um exemplo de template usando componentes padrões.
As diretivas @extendsTemplate e @includeTemplate permitem
a substituição dinâmica das views através do Templates\Handler.
--}}

@extendsTemplate('core::layout.admin-full')

@section('main-area')

    <header>
        <h2 class="h3 p-3 m-0 text-secondary">{{ $title }}</h2>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0 pl-3 rounded-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
    </header>

    <section class="p-3">
        <div class="page-wrapper">
        @yield('page-area')
        </div>
    </section>
    
@endsection