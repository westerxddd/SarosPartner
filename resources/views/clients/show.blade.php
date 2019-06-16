@extends('adminlte::page')

@section('title', 'Klient - SarosPartners')

@section('content')

    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-saros">
                    <div class="widget-user-image">
                        <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{$client->name}}</h3>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        @if(isset($client->user))
                        <li><a><strong>Email</strong> <span class="pull-right">{{$client->user->email}}</span></a></li>
                        <li><a><strong>Data dołączenia</strong> <span class="pull-right">{{$client->user->created_at->format('d.m.Y H:i')}}</span></a></li>
                        @endif
                        @if(isset($client->nip))
                        <li><a><strong>NIP</strong> <span class="pull-right">{{$client->nip}}</span></a></li>
                        @endif
                        <li><a><strong>Punkty</strong> <span class="pull-right">{{number_format($client->getPoints(),0,',',' ')}}</span></a></li>
                    </ul>
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::open(['route' => ['clients.count-points','client'=>$client->id],'class'=>'dt-filters-container']) }}
                            @csrf
                            <div class="form-group">
{{--                                {{ Form::label('title','Tytuł:') }}--}}
                                {{ Form::text('title','',['class'=>'form-control','placeholder'=>'Tytuł']) }}
                            </div>
                            <div class="form-group">
{{--                                {{ Form::label('points','Punkty:') }}--}}
                                {{ Form::number('points','',['class'=>'form-control','placeholder'=>'+/- Punkty','step'=>'0.01' ]) }}
                            </div>
                            <div class="form-group form-submit">
                                {{ Form::submit('Podlicz',['class'=>'btn btn-primary']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>

            @if(!isset($client->user))
                @include('users.create')
            @endif
        </div>

        @if(isset($client->articles))
            <div class="col-lg-8 col-12">
                <div class="box box-saros">
                    <div class="box-header with-border">
                        <h3 class="box-title">Artykuły</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="dt-filters" class="dt-filters-container">
                                    <div class="form-group">
                                        <label>
                                            Prefiks:<br>
                                            <input type="text" id="prefix" name="prefiks" placeholder="Prefiks" class="form-control">
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Min. wartość netto:<br>
                                            <input type="text" id="min-netto" name="min-netto" placeholder="Min. wartość netto" class="form-control">
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Max. wartość netto:<br>
                                            <input type="text" id="max-netto" name="max-netto" placeholder="Max. wartość netto" class="form-control">
                                        </label>
                                    </div>
                                    <div class="form-group form-submit">
                                        <label>
                                            <button class="btn btn-primary dt-filter">Filtruj</button>
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped table-hover" id="articles-table">
                                    <thead>
                                    <tr>
                                        <th style="width: 25px;">Lp.</th>
                                        <th>Prefiks</th>
                                        <th>Wartość netto</th>
                                        <th style="width: 25px;">x2</th>
                                        <th>Dodano</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                        d.clientId = {{$client->id}},
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
                    { data: 'multiple', name: 'multiple'},
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
