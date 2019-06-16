@extends('adminlte::page')

@section('title', 'Ustawienia - SarosPartners')

@section('content_header')
    <h1>Ustawienia</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-saros">
                    <div class="box-body">
                        <a href="{{route('import')}}" class="btn btn-sm btn-danger"><i class="fa fa-download" aria-hidden="true" style="margin-right: 5px;"></i><span>Wycofaj import</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="box box-saros">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edytuj dane użytkownika</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{ Form::open(['route' => 'change-settings']) }}
                        <div class="box-body">
                            @csrf
                            <div class="form-group">
                                {{ Form::label('email','Adres email:') }}
                                {{ Form::email('email',$user->email,['class'=>'form-control','placeholder'=>'Adres email']) }}
                            </div>
                            @if(!$user->isAdmin())
                                <div class="form-group">
                                    {{ Form::label('nip','NIP:') }}
                                    {{ Form::text('nip',$user->client->nip ? $user->client->nip:'',['class'=>'form-control','placeholder'=>'NIP']) }}
                                </div>
                            @endif
                            <div class="form-group">
                                {{ Form::label('new_password','Nowe hasło:') }}
                                {{ Form::password('new_password',['class'=>'form-control','placeholder'=>'Nowe hasło']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('confirm_password','Potwierdź hasło:') }}
                                {{ Form::password('confirm_password',['class'=>'form-control','placeholder'=>'Potwierdź hasło']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Edytuj',['class'=>'btn btn-sm btn-primary']) }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                        {{ Form::close() }}
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">

                    </div>
                </div>
            </div>
            @if($user->isAdmin())
                @include('sites.admin.settings')
            @endif
        </div>
    </div>
@stop
