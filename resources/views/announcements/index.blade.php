@extends('adminlte::page')

@section('title', 'Ogłoszenia - SarosPartners')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="box box-saros">
                @include('announcements.create')
            </div>

        </div>
            <div class="col-lg-8">
                <div class="box box-saros">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ogłoszenia</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body d-flex flex-wrap">
                    @if(isset($announcements) && count($announcements)>0)
                        @foreach($announcements as $announcement)
                            <div class="announcement-item col-lg-4 @if($announcement->isDuring()) active @endif">
                                <div class="announcement-img-wrapper">
                                    @if($announcement->getImageSrc() != false)
                                        <img src="{{$announcement->getImageSrc()}}" alt="" style="max-width: 100%">
                                    @endif
                                </div>
                                <h3>{{$announcement->name}}</h3>
                                <p>{{$announcement->desc}}</p>
                                @if(auth()->user()->isAdmin())
                                    <p>
                                        <strong>Od:</strong> {{\Illuminate\Support\Carbon::createFromTimeString($announcement->start_at)->format('d.m.Y H:i')}}<br>
                                        <strong>Do:</strong> {{\Illuminate\Support\Carbon::createFromTimeString($announcement->end_at)->format('d.m.Y H:i')}}
                                    </p>
                                @endif
                                <div class="item-btns">
                                    <a href="{{route('announcements.edit',$announcement->id)}}">
                                        <button class="btn btn-sm btn-success">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <form method="POST" action="{{route('announcements.delete',['$announcement'=>$announcement->id])}}" accept-charset="UTF-8" onsubmit="confirm('Czy na pewno chcesz usunąć ogłoszenie: {{ $announcement->name }}?')">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>

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

