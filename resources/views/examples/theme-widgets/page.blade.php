@extends('core::document')

@section('title', $title)

@section('body')
    
    {{-- <body data-spy="scroll" data-target="#my-navbar" data-offset="100"> --}}

    @include('module-core::partials.header')

    <main>
        @include('module-core::components.test-cards')
        @include('module-core::components.test-buttons')
        @include('module-core::components.test-alerts')
        @include('module-core::components.test-badges')
        @include('module-core::components.test-popovers')
        @include('module-core::components.test-forms')
        @include('module-core::components.test-images')
        @include('module-core::components.test-tables')
        @include('module-core::components.test-list-groups')
        @include('module-core::components.test-navs')
        @include('module-core::components.test-jumbotrons')
        @include('module-core::components.test-progress')
        @include('module-core::components.test-tipograph')
        @include('module-core::components.test-modal')
    </main>

    @include('module-core::partials.footer')
    
@endsection

@push('styles')
<style>
	#typography {
		margin-top: -3rem;
	}
	.modal {
		position: relative;
		top: auto;
		right: auto;
		bottom: auto;
		left: auto;
		z-index: 1;
		display: block;
	}
</style>
@endpush

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>
    <script>
   $(function () {
	   $('[data-toggle="popover"]').popover();
	   $('[data-toggle="tooltip"]').tooltip();

	   $('#hljs-theme-toggler').click(function () {
		   var m = $('#hljs-theme').attr('media');
		   m = ('none' == m) ? '' : 'none';
		   $('#hljs-theme').attr('media', m);
	   });

	   $('#popover-toggler').click();
   });
   hljs.initHighlightingOnLoad();
</script>

@endpush
