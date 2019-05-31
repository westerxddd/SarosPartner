@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Promocje</h1>
@stop

@section('content')

    <div class="container-fluid">
        @if(count($deals)>0)
            <div class="row">
                @if(count($deals)>0)

                    <div class="row">
                        @foreach($deals as $deal)
                            <div class="col-lg-4">
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-primary">
                                        <div class="widget-user-image">
                                            <i class="fa fa-star fa-3x" aria-hidden="true"></i>
                                        </div>
                                        <!-- /.widget-user-image -->
                                        <h3 class="widget-user-username">{{$deal->name}}</h3>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li class="img-wrapper"><img src="{{$deal->getImageSrc()}}" alt=""></li>
                                            <li><a>{{$deal->desc}}</a></li>
                                            <li><a><strong>Od:</strong><span class="pull-right">{{date('d.m.Y H:i', strtotime($deal->start_at))}}</span></a></li>
                                            <li><a><strong>Do:</strong><span class="pull-right">{{date('d.m.Y H:i', strtotime($deal->end_at))}}</span></a></li>
                                            @if(strlen($deal->extra)>0)
                                                <li>
                                                    <a>
                                                        <p><strong>Prefiksy objęte promocją:</strong></p>
                                                        @foreach(explode('%|%',$deal->extra) as $prefix)
                                                            <span class="btn btn-sm btn-primary">
                                                            {{strtoupper($prefix)}}
                                                        </span>
                                                        @endforeach
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            Aktualnie nie ma żadnych aktywnych promocji!
        @endif
    </div>
@stop
