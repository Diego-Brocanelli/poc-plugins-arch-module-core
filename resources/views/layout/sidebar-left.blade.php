@php 
    $items = [
        'Cras justo odio',
        'Dapibus ac facilisis in',
        'Morbi leo risus',
        'Porta ac consectetur ac',
        'Vestibulum at eros',
    ];
@endphp

    <div id="js-sidemenu" class="list-group list-group-flush d-none d-sm-block">

        @foreach($items as $label)

        <a href="#" 
           class="list-group-item list-group-item-action bg-transparent text-white-50" 
           data-toggle="collapse" data-target="#js-submenu-{{ $loop->index }}">
            {{ $label }}
            <i class="fas fa-angle-right float-right"></i>
        </a>

        <div id="js-submenu-{{ $loop->index }}" class="collapse">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-transparent">Morbi leo risus</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent">Cras justo odio</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent">Porta ac consectetur ac</a>
            </div>
        </div>

        @endforeach
    
    </div>