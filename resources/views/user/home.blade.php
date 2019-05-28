@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Pulpit</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            @if(isset(auth()->user()->client))
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-primary">
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
        @if(auth()->user()->hasArticles())
            <div class="col-lg-8 col-12">
                <div class="box box-primary">
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
                                        <th>Lp.</th>
                                        <th>Prefiks</th>
                                        <th>Wartość netto</th>
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
