@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle') | @yield('subtitle') @endif
@stop

{{-- Include pink theme CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('css/pink-theme.css') }}">
@endpush

{{-- Include sidebar menu --}}

@include('layouts.sidebar')

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version') ?? '1.0.0' }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'Mi Aplicación') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
<script>

    $(document).ready(function() {
        // Add your common script logic here...
    });

</script>
@endpush

{{-- Add common CSS customizations --}}

@push('css')
<style type="text/css">
    :root {
        --pink-primary: #FFD6E8;
        --pink-light: #FFE8F3;
        --pink-dark: #F5B3D4;
        --blue-pastel: #D6E8F5;
        --green-pastel: #D6F5E8;
        --purple-pastel: #E8D6F5;
        --yellow-pastel: #F5F0D6;
    }
    
    body {
        background-color: #FFF8FC;
    }
    
    /* Navbar Rosa Pastel Claro */
    .navbar-light {
        background-color: #FFD6E8 !important;
        border-bottom: 3px solid #F5B3D4;
    }
    
    .navbar-light .navbar-brand {
        color: #8B4D6D !important;
        font-weight: bold;
        font-size: 1.4rem;
    }
    
    .navbar-light .nav-link {
        color: #8B4D6D !important;
    }
    
    .navbar-light .nav-link:hover {
        color: #6B3D5D !important;
    }
    
    /* Sidebar Rosa Pastel */
    .sidebar-dark-danger {
        background-color: #F5B3D4 !important;
    }
    
    .sidebar-dark-danger .brand-text {
        color: #8B4D6D !important;
    }
    
    .sidebar-dark-danger .nav-link {
        color: #8B4D6D !important;
    }
    
    .sidebar-dark-danger .nav-link:hover,
    .sidebar-dark-danger .nav-link.active {
        background-color: rgba(255, 214, 232, 0.5) !important;
        color: #6B3D5D !important;
        font-weight: bold;
    }
    
    /* Brand Link */
    .brand-link {
        background-color: #F5B3D4 !important;
        color: #8B4D6D !important;
    }
    
    .brand-link:hover {
        background-color: #FFD6E8 !important;
    }
    
    /* Colores por Módulo */
    
    /* Clientes - Azul Pastel */
    .badge-clientes {
        background-color: #D6E8F5 !important;
        color: #4D7BA8 !important;
    }
    
    .btn-clientes {
        background-color: #D6E8F5 !important;
        border-color: #A8C8E8 !important;
        color: #4D7BA8 !important;
    }
    
    .btn-clientes:hover {
        background-color: #A8C8E8 !important;
        color: #2D5B88 !important;
    }
    
    /* Productos - Verde Pastel */
    .badge-productos {
        background-color: #D6F5E8 !important;
        color: #4D8B7A !important;
    }
    
    .btn-productos {
        background-color: #D6F5E8 !important;
        border-color: #A8E8D6 !important;
        color: #4D8B7A !important;
    }
    
    .btn-productos:hover {
        background-color: #A8E8D6 !important;
        color: #2D6B5A !important;
    }
    
    /* Empleados - Púrpura Pastel */
    .badge-empleados {
        background-color: #E8D6F5 !important;
        color: #7A4D8B !important;
    }
    
    .btn-empleados {
        background-color: #E8D6F5 !important;
        border-color: #D6A8E8 !important;
        color: #7A4D8B !important;
    }
    
    .btn-empleados:hover {
        background-color: #D6A8E8 !important;
        color: #5A2D6B !important;
    }
    
    /* Categorías - Amarillo Pastel */
    .badge-categorias {
        background-color: #F5F0D6 !important;
        color: #8B8B4D !important;
    }
    
    .btn-categorias {
        background-color: #F5F0D6 !important;
        border-color: #E8E8A8 !important;
        color: #8B8B4D !important;
    }
    
    .btn-categorias:hover {
        background-color: #E8E8A8 !important;
        color: #6B6B2D !important;
    }
    
    /* Pedidos - Rosa Pastel (Principal) */
    .badge-pedidos {
        background-color: #FFD6E8 !important;
        color: #8B4D6D !important;
    }
    
    .btn-pedidos {
        background-color: #FFD6E8 !important;
        border-color: #F5B3D4 !important;
        color: #8B4D6D !important;
    }
    
    .btn-pedidos:hover {
        background-color: #F5B3D4 !important;
        color: #6B3D5D !important;
    }
    
    /* Botones Generales */
    .btn-danger,
    .btn-primary,
    .btn-info {
        background-color: #FFD6E8 !important;
        border-color: #FFD6E8 !important;
        color: #8B4D6D !important;
    }
    
    .btn-danger:hover,
    .btn-primary:hover,
    .btn-info:hover {
        background-color: #F5B3D4 !important;
        border-color: #F5B3D4 !important;
        color: #6B3D5D !important;
    }
    
    /* Cards */
    .card-outline-danger {
        border-top: 3px solid #FFD6E8 !important;
    }
    
    .card {
        background-color: #FFFBFE !important;
        border: 1px solid #FFE0ED !important;
    }
    
    .card-header {
        background-color: #FFE8F3 !important;
        color: #8B4D6D !important;
        font-weight: bold;
    }
    
    /* Badges */
    .badge-danger {
        background-color: #FFD6E8 !important;
        color: #8B4D6D !important;
    }
    
    .badge-info {
        background-color: #D6E8F5 !important;
        color: #4D7BA8 !important;
    }
    
    .badge-success {
        background-color: #D6F5E8 !important;
        color: #4D8B7A !important;
    }
    
    .badge-warning {
        background-color: #F5F0D6 !important;
        color: #8B8B4D !important;
    }
    
    /* Links */
    a {
        color: #F5B3D4;
    }
    
    a:hover {
        color: #E08BA8;
    }
    
    /* Headers */
    .content-header {
        border-bottom: 3px solid #FFD6E8 !important;
    }
    
    .content-header h1 {
        color: #8B4D6D;
    }
    
    /* Tablas */
    tbody tr:hover {
        background-color: rgba(255, 214, 232, 0.2) !important;
    }
    
    table thead {
        background-color: #FFE8F3 !important;
    }
    
    table thead th {
        color: #8B4D6D !important;
        font-weight: bold;
    }
    
    /* Inputs */
    .form-control,
    .form-select {
        border-color: #FFD6E8 !important;
        background-color: #FFFBFE !important;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #FFD6E8 !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 214, 232, 0.25) !important;
        background-color: #FFF8FC !important;
    }
    
    /* Alert */
    .alert-success {
        background-color: #D6F5E8;
        border-color: #A8E8D6;
        color: #4D8B7A;
    }
    
    .alert-info {
        background-color: #D6E8F5;
        border-color: #A8C8E8;
        color: #4D7BA8;
    }
    
    .alert-warning {
        background-color: #F5F0D6;
        border-color: #E8E8A8;
        color: #8B8B4D;
    }
    
    .alert-danger {
        background-color: #FFD6E8;
        border-color: #F5B3D4;
        color: #8B4D6D;
    }
    
    /* Cuadros de éxito */
    .text-success {
        color: #4D8B7A !important;
    }
    
    .text-info {
        color: #4D7BA8 !important;
    }
    
    .text-warning {
        color: #8B8B4D !important;
    }
    
    .text-danger {
        color: #8B4D6D !important;
    }
    
    /* Título Home */
    .display-4 {
        color: #8B4D6D !important;
    }
    
    /* Cuadros estadísticas */
    .info-box {
        background-color: #FFFBFE;
        border-top: 3px solid #FFD6E8;
    }
    
    .info-box-icon {
        background-color: #FFE8F3 !important;
    }
</style>
@endpush
