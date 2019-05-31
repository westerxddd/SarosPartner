@extends('adminlte::page')

@section('title', 'Import - SarosPartners')

@section('content_header')
    <h1>Import</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="box box-saros">
                @include('import.client')
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="box box-saros">
                @include('import.articles')
            </div>
        </div>
    </div>
@stop
