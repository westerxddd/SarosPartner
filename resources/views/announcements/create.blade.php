{{ Form::open(['route' => isset($announcement) ? ['announcements.update',$announcement->id] : 'announcements.store','files'=>true]) }}
    @if(isset($announcement))
        {{ method_field('PATCH') }}
    @endif
    <div class="box-header with-border">
        <h3 class="box-title">{{isset($announcement)?'Edtuj':'Dodaj'}} ogłoszenie</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @csrf
        <div class="form-group">
            {{ Form::label('name','Tytuł') }}
            {{ Form::text('name',isset($announcement->name) ? $announcement->name : '' ,['class'=>'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('desc','Opis') }}
            {{ Form::textarea('desc',isset($announcement->desc) ? $announcement->desc : '',['class'=>'form-control', 'rows'=>3]) }}
        </div>
        <div class="form-group">
            {{ Form::label('start_at','Start') }}
            <div class='input-group datetimepicker'>
                <input type='text' name="start_at" class="form-control" value="{{date('d.m.Y H:i', isset($announcement->start_at) ? strtotime($announcement->start_at) : time())}}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('end_at','Koniec') }}
            <div class='input-group datetimepicker'>
                <input type='text' name="end_at" class="form-control" value="{{date('d.m.Y H:i', isset($announcement->end_at) ? strtotime($announcement->end_at ) : time()+3600*24)}}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        @if(isset($announcement->image))
            <div class="form-group">
                <div class="announcement-img-wrapper">
                    <img src="{{$announcement->getImageSrc()}}" alt="">
                </div>
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('image',isset($announcement->image)?'Wybierz nowy obraz (maks. 5MB)' : 'Obraz (maks. 5MB)') }}
            {{ Form::file('image') }}
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="form-group">
            {{ Form::submit(isset($announcement->end_at) ?'Edytuj':'Dodaj',['class'=>'btn btn-sm btn-primary']) }}
        </div>
    </div>
    <!-- /.box-footer -->
{{ Form::close() }}
