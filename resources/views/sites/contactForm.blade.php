@extends('adminlte::page')

@section('title', 'Ustawienia - SarosPartners')

@section('content_header')
    <h1>Formularz kontaktowy</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-lg-4">
               <div class="box box-saros">
                   <div class="box-header with-border">
                       <h3 class="box-title">Wyślij wiadomość</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       {{ Form::open(['route' => 'send-msg']) }}
                       <div class="box-body">
                           @csrf
                           <div class="form-group">
                               {{ Form::label('title','Tytuł:') }}
                               {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Tytuł']) }}
                           </div>
                           <div class="form-group">
                               {{ Form::label('email','Adres email:') }}
                               {{ Form::email('email',auth()->user()->email,['class'=>'form-control','placeholder'=>'Adres email']) }}
                           </div>
                           <div class="form-group">
                               {{ Form::label('text','Treść wiadomości:') }}
                               {{ Form::textarea('text','',['class'=>'form-control','placeholder'=>'Treść wiadomości','rows' => 4, 'style' => 'resize:none']) }}
                           </div>
                           <div class="form-group">
                               {{ Form::submit('Wyślij',['class'=>'btn btn-sm btn-primary']) }}
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
        </div>
    </div>
@stop
