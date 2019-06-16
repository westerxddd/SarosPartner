{{ Form::open(['route' => 'import.store','files'=>true]) }}
<div class="box-header with-border">
    <h3 class="box-title">Import artykułów</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
    @csrf
    {{Form::hidden('type','articles')}}
    <div class="form-group">
        {{ Form::label('csv_file','Plik csv z artykułami:') }}
        {{ Form::file('csv_file') }}
    </div>
    <div class="form-group">
        {{ Form::label('extra','Prefiksy artykułów objętych podwójną liczbą pktów:') }}
        {{ Form::select('extra[]',[],[],['class'=>'form-control select2','multiple'=>'multiple','id'=>'prefixes']) }}
    </div>
</div>
<!-- /.box-body -->
<div class="box-footer clearfix">
    <div class="form-group">
        {{ Form::submit('Importuj',['class'=>'btn btn-sm btn-primary']) }}
    </div>
</div>
<!-- /.box-footer -->
{{ Form::close() }}
