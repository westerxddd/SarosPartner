{{ Form::open(['route' => 'announcements.store','files'=>true]) }}
    <div class="box-header with-border">
        <h3 class="box-title">Dodaj ogłoszenie</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @csrf
        <div class="form-group">
            {{ Form::label('name','Tytuł') }}
            {{ Form::text('name','',['class'=>'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('desc','Opis') }}
            {{ Form::textarea('desc','',['class'=>'form-control', 'rows'=>3]) }}
        </div>
        <div class="form-group">
            {{ Form::label('start_at','Start') }}
            <div class='input-group datetimepicker'>
                <input type='text' name="start_at" class="form-control" value="{{date('d.m.Y H:i')}}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('end_at','Koniec') }}
            <div class='input-group datetimepicker'>
                <input type='text' name="end_at" class="form-control" value="{{date('d.m.Y H:i',time()+3600*24)}}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('image','Obraz (maks. 5MB)') }}
            {{ Form::file('image') }}
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="form-group">
            {{ Form::submit('Dodaj',['class'=>'btn btn-sm btn-primary']) }}
        </div>
    </div>
    <!-- /.box-footer -->
{{ Form::close() }}
