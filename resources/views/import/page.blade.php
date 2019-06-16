@extends('adminlte::page')

@section('title', 'Import - SarosPartners')

@section('content_header')
    <h1>Import</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="box box-saros">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Lp.</th>
                            <th>Import</th>
                            <th>Data importu</th>
                            <th>Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($imports as $key => $import)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$import->id}}</td>
                                <td>{{$import->created_at->format('d.m.Y H:i:s')}}</td>
                                <td>
                                    <a href="{{route('import.undo',$import->id)}}" onclick="return confirm('Jesteś pewien, że chcesz wycofać import: {{$import->id}}?')">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-undo" aria-hidden="true"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
