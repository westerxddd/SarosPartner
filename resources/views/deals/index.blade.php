@extends('adminlte::page')

@section('title', 'Promocje - SarosPartners')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="box box-saros">
                @include('deals.create')
            </div>

        </div>
        <div class="col-lg-8">
            <div class="box box-saros">
                <div class="box-header with-border">
                    <h3 class="box-title">Promocje</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                @if(count($deals)>0)
                    @foreach($deals as $deal)
                        <div class="announcement-item col-lg-4 @if($deal->isDuring()) active @endif">
                            <div class="announcement-img-wrapper">
                                @if($deal->getImageSrc() != false)
                                    <img src="{{$deal->getImageSrc()}}" alt="">
                                @endif
                            </div>
                            <h3>{{$deal->name}}</h3>
                            <p>{{$deal->desc}}</p>
                            <p>
                                <strong>Od:</strong> {{\Illuminate\Support\Carbon::createFromTimeString($deal->start_at)->format('d.m.Y H:i')}}<br>
                                <strong>Do:</strong> {{\Illuminate\Support\Carbon::createFromTimeString($deal->end_at)->format('d.m.Y H:i')}}
                            </p>

                            @if($prefixes = $deal->getPrefixes())
                                <p>
                                    <strong>Prefiksy objęte promocją:</strong><br>
                                    @foreach($prefixes as $prefix)
                                        <span class="btn btn-sm btn-primary">
                                        {{$prefix}}
                                    </span>
                                    @endforeach
                                </p>
                            @endif
                        </div>
                    @endforeach
                @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                tags: true
            });

            $(function () {
                $('.datetimepicker').datetimepicker({
                        locale: 'pl'
                    }
                );
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

