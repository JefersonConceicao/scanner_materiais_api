@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">                    
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                <img 
                                    src="{{ Auth::user()->url_photo 
                                        ? Auth::user()->url_photo 
                                        : asset('/assets/default_icon.png')
                                    }}"
                                    class="user-image menuImgProfile"
                                    alt="foto de perfil union"
                                />

                                <span class="hidden-xs"> {{ Auth::user()->name }} </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-bahia">
                                    <img 
                                        class="subMenuImgProfile"
                                        src="{{ Auth::user()->url_photo 
                                            ? Auth::user()->url_photo 
                                            : asset('/assets/default_icon.png')
                                        }}"
                                    />
                                    <p> 
                                        {{ Auth::user()->name }}   
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row"> 
                                        <div class="col-md-12 text-center">
                                            <a href="/users/perfil" class="btn btn-default" style="width:100%;">
                                                <b> 
                                                    <i class="fa fa-user"> </i> &nbsp; 
                                                    Meu Perfil 
                                                </b> 
                                            </a>  
                                        </div>
                                    </div>
           
                    
                                </li> 
                                <li class="user-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a 
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                href="/auth/logout" class="btn btn-danger" style="width:100%"
                                            > 
                                                <i class="fa fa-fw fa-power-off"> </i>
                                                    Sair
                                            </a>
                                        </div>
                                    </div> 
                                </li>
                            </ul>
                        </li>

                        <li>
                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                    {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                        </li> 

                        @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
                        <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar" @if(!config('adminlte.right_sidebar_slide')) data-controlsidebar-slide="false" @endif>
                                    <i class="{{config('adminlte.right_sidebar_icon')}}"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        <div id="containerLoadingBar" style="display:none;">
            <div id="progressLoadingBar"> </div>
        </div>  

        <div id="nivel1" class="modal fade" role="dialog"> 
            <div class="modal-dialog">
                <div class="modal-content">
                    @yield('modal')
                </div>
            </div>
        </div>

        <div id="nivel2" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    @yield('modal')
                </div>
            </div>
        </div>

        <div id="nivel3" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                
                </div>
            </div>
        </div>


        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
            @endif

            <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
            <!-- /.content -->

            @if(config('adminlte.layout') == 'top-nav')
                </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

        @hasSection('footer')
        <footer class="main-footer">
            @yield('footer')
        </footer>
        @endif

        @if(config('adminlte.right_sidebar') and (config('adminlte.layout') != 'top-nav'))
            <aside class="control-sidebar control-sidebar-{{config('adminlte.right_sidebar_theme')}}">
                @yield('right-sidebar')
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        @endif

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
