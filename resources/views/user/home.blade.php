@extends('adminlte::page')

@section('title', 'Pulpit - SarosPartners')

@section('content_header')
    <h1>Pulpit</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3">
            @if(isset(auth()->user()->client))
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-saros">
                        <div class="widget-user-image">
                            <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{auth()->user()->client->name}}</h3>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a><strong>Email</strong> <span class="pull-right">{{auth()->user()->email}}</span></a></li>
                            <li><a><strong>Data dołączenia</strong> <span class="pull-right">{{auth()->user()->created_at->format('d.m.Y H:i')}}</span></a></li>
                            @if(isset(auth()->user()->client->nip))
                                <li><a><strong>NIP</strong> <span class="pull-right">{{auth()->user()->client->nip}}</span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{number_format(auth()->user()->getPoints(),0,',',' ')}}</h3>

                    <p>Punkty</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-saros">
                <div class="box-header with-border">
                    <h3 class="box-title">Promocje</h3>
                </div>
                <div class="box-body bg-gray-light">
                    @if(count($deals)>0)
                        <ul class="timeline">
                            @foreach($deals as $deal)
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-blue">
                                       {{$deal->created_at->format('d.m.Y')}}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->

                                <!-- timeline item -->
                                <li>
                                    <!-- timeline icon -->
                                    <i class="fa fa-star bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{$deal->created_at->format('H:i')}}</span>

                                        <h3 class="timeline-header">{{$deal->name}}</h3>
                                        <div class="announcement-img-wrapper">
                                            @if($deal->getImageSrc() != false)
                                                <img src="{{$deal->getImageSrc()}}" alt="">
                                            @endif
                                        </div>
                                        <div class="timeline-body">
                                            {{$deal->desc}}
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                            @endforeach
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                        </ul>
                    @else
                        <p>Aktualnie nie ma żadnych aktywnych promocji!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-saros">
                <div class="box-header with-border">
                    <h3 class="box-title">Ogłoszenia</h3>
                </div>
                <div class="box-body bg-gray-light">
                    @if(count($announcements)>0)
                        <ul class="timeline">
                        @foreach($announcements as $announcement)
                            <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-blue">
                                       {{$announcement->created_at->format('d.m.Y')}}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->

                                <!-- timeline item -->
                                <li>
                                    <!-- timeline icon -->
                                    <i class="fa fa-bullhorn bg-purple"></i>
                                    <div class="timeline-item">

                                        <span class="time"><i class="fa fa-clock-o"></i> {{$announcement->created_at->format('H:i')}}</span>

                                        <h3 class="timeline-header">{{$announcement->name}}</h3>
                                        <div class="announcement-img-wrapper">
                                            @if($announcement->getImageSrc() != false)
                                                <img src="{{$announcement->getImageSrc()}}" alt="" style="max-width: 100%">
                                            @endif
                                        </div>
                                        <div class="timeline-body">
                                            <p>{{$announcement->desc}}</p>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                            @endforeach
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    @else
                        <p>Aktualnie nie ma żadnych ogłoszeń!</p>
                    @endif
                </div>
            </div>
        </div>
        {{--@if(auth()->user()->hasArticles())--}}
            {{--<div class="col-lg-8 col-12">--}}
                {{--<div class="box box-saros">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">Artykuły</h3>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-12">--}}
                                {{--<form id="dt-filters" class="dt-filters-container">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>--}}
                                            {{--Prefiks:<br>--}}
                                            {{--<input type="text" id="prefix" name="prefiks" placeholder="Prefiks" class="form-control">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>--}}
                                            {{--Min. wartość netto:<br>--}}
                                            {{--<input type="text" id="min-netto" name="min-netto" placeholder="Min. wartość netto" class="form-control">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>--}}
                                            {{--Max. wartość netto:<br>--}}
                                            {{--<input type="text" id="max-netto" name="max-netto" placeholder="Max. wartość netto" class="form-control">--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group form-submit">--}}
                                        {{--<label>--}}
                                            {{--<button class="btn btn-primary dt-filter">Filtruj</button>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-lg-12">--}}
                                {{--<table class="table table-striped table-hover" id="articles-table">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th style="width: 30px;">Lp.</th>--}}
                                        {{--<th>Prefiks</th>--}}
                                        {{--<th>Wartość netto</th>--}}
                                        {{--<th>Dodano</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}

    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            oTable = $('#articles-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                searching: false,
                ajax: {
                    url: '{!! route('data.articles') !!}',
                    data: function (d) {
                        d.clientId = {{auth()->user()->client->id}},
                            d.prefix = $('#prefix').val();
                        d.minnetto =  $('#min-netto').val();
                        d.maxnetto =  $('#max-netto').val();
                    }
                },
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Polish.json"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false },
                    { data: 'prefix', name: 'prefix' },
                    { data: 'netto', name: 'netto' },
                    { data: 'created_at', name: 'created_at'}
                ]
            });

            $('#dt-filters').on('submit', function(e){
                e.preventDefault();
                oTable.draw();
            });
        });
    </script>

@stop
