@section('title', 'AdminLTE')

@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-blue layout-top-nav')

@section('body')
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <!-- Logo -->
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                </a>
            </nav>
        </header>

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container">
                <section class="notifications container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('partials.notifications')
                        </div>
                    </div>
                </section>
                @if(isset($user->token))
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>Rejestracja nowego użytkownika</h1>
                    </section>
                @endif

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box box-saros">
                                @if(isset($user->token))
                                    {{ Form::open(['route' => ['users.store',$user->id]]) }}
                                    <div class="box-body">
                                        @csrf
                                        <div class="form-group">
                                            {{ Form::label('email','Adres email:') }}
                                            {{ Form::email('email',$user->email,['class'=>'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('password','Hasło do konta:') }}
                                            {{ Form::password('password',['class'=>'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('confirm_password','Potwierdź hasło:') }}
                                            {{ Form::password('confirm_password',['class'=>'form-control']) }}
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                        <div class="form-group">
                                            {{ Form::submit('Zarejestruj',['class'=>'btn btn-sm btn-primary']) }}
                                        </div>
                                    </div>
                                    <!-- /.box-footer -->
                                    {{ Form::close() }}
                                @endif
                                @if(session('success'))
                                    <a href="{{route('login')}}">
                                        <div class="info-box" style="display: flex; align-items: center">
                                            <span class="info-box-icon bg-aqua" style="min-width: 100px"><i class="fa fa-sign-in"></i></span>

                                            <div class="info-box-content" style="margin-left: 0;">
                                                <span class="info-box-text"><p>Przejdz do panelu logowania</p></span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop



