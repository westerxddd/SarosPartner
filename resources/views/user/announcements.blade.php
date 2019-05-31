@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Ogłoszenia</h1>
@stop

@section('content')

    <div class="container-fluid">
        @if(count($announcements)>0)
            <div class="row">
                @if(count($announcements)>0)

                    <div class="row">
                        @foreach($announcements as $announcement)
                            <div class="col-lg-3">
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-saros">
                                        <div class="widget-user-image">
                                            <i class="fa fa-bullhorn fa-3x" aria-hidden="true"></i>
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <h3 class="widget-user-username">{{$announcement->name}}</h3>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li class="img-wrapper"><img src="{{$announcement->getImageSrc()}}" alt=""></li>
                                            <li><a>{{$announcement->desc}}</a></li>
                                            <li><a><strong>Od:</strong><span class="pull-right">{{date('d.m.Y H:i', strtotime($announcement->start_at))}}</span></a></li>
                                            <li><a><strong>Do:</strong><span class="pull-right">{{date('d.m.Y H:i', strtotime($announcement->end_at))}}</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            Aktualnie nie ma żadnych ogłoszeń!
        @endif
    </div>
@stop
