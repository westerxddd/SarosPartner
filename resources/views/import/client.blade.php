{{ Form::open(['route' => 'import.store','files' =>true,'enctype'=>'multipart/form-data']) }}
<div class="box-header with-border">
    <h3 class="box-title">Import kontrahentów</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
    @csrf
    {{Form::hidden('type','clients')}}
    <div class="form-group">
        {{ Form::label('csv_file','Plik csv z kontrahentami:') }}
        {{ Form::file('csv_file') }}
    </div>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
    <div class="form-group">
        {{ Form::submit('Importuj',['class'=>'btn btn-sm btn-primary','data-toggle'=>"modal",'data-target'=>"#loadingModal"]) }}
    </div>
</div>
<!-- /.box-footer -->
{{ Form::close() }}
