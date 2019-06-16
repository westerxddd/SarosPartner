@extends('adminlte::page')

@section('title', 'Pulpit - SarosPartners')

@section('content_header')
    <h1>Pulpit</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="box box-saros">
                <div class="box-header with-border">
                    <h3 class="box-title">Kontrahenci</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Filtry</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="dt-filters" class="dt-filters-container">
                                <div class="form-group">
                                    <label>
                                        Nazwa:<br>
                                        <input type="text" id="name" name="name" placeholder="Nazwa" class="form-control">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        NIP:<br>
                                        <input type="text" id="nip" name="nip" placeholder="NIP" class="form-control">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Min. pktów:<br>
                                        <input type="text" id="min-pts" name="min-pts" placeholder="Min. pktów" class="form-control">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Max. pktów:<br>
                                        <input type="text" id="max-pts" name="max-pts" placeholder="Max. pktów" class="form-control">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Kontrahenci do aktywacji
                                        <input type="checkbox" id="activation" name="activation">
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
                            <table class="table table-striped table-hover" id="clients-table">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">Lp.</th>
                                        <th>Nazwa</th>
                                        <th>NIP</th>
                                        <th>Pkty</th>
                                        <th>Akcja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="box box-saros">
                @include('import.articles')
            </div>
            <div class="box box-saros">
                @include('import.client')
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                tags: true
            });

            $('select#prefixes').select2({
                ajax: {
                    url: '{{route('data.prefixes')}}',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            prefix: params.term,
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.prefix,
                                    text: item.prefix
                                };
                            })
                        };
                    }
                }
            });

            oTable = $('#clients-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                searching: false,
                ajax: {
                    url: '{!! route('data.clients') !!}',
                    data: function (d) {
                        d.name = $('#name').val();
                        d.nip = $('#nip').val();
                        d.minpts =  $('#min-pts').val();
                        d.maxpts =  $('#max-pts').val();
                        d.activation = $('input[name=activation]:checked').length;
                    }
                },
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Polish.json"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
                    { data: 'name', name: '' },
                    { data: 'nip', name: 'nip' },
                    { data: 'amount', name: 'amount'},
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#dt-filters').on('submit', function(e){
                e.preventDefault();
                oTable.draw();
            });
        });
    </script>

@stop
