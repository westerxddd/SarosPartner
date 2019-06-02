{{ Form::open(['route' => isset($deal) ? ['deals.update',$deal->id] : 'deals.store','files'=>true]) }}
    @if(isset($deal))
        {{ method_field('PATCH') }}
    @endif
    <div class="box-header with-border">
        <h3 class="box-title">{{isset($deal)?'Edtuj':'Dodaj'}} promocję</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @csrf
        <div class="form-group">
            {{ Form::label('name','Tytuł') }}
            {{ Form::text('name',isset($deal->name) ? $deal->name : '' ,['class'=>'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('desc','Opis') }}
            {{ Form::textarea('desc',isset($deal->desc) ? $deal->desc : '',['class'=>'form-control', 'rows'=>3]) }}
        </div>
        <div class="form-group">
            {{ Form::label('extra','Prefiksy artykułów objętych promocją') }}
            {{ Form::select('extra[]', isset($deal) && strlen($deal->extra)>0 ? $deal->getPrefixesSelect2():[], isset($deal) && strlen($deal->extra)>0 ?$deal->getPrefixes():[],['class'=>'form-control select2','multiple'=>'multiple']) }}
        </div>
        <div class="form-group">
            {{ Form::label('start_at','Start') }}
            <div class='input-group datetimepicker'>
                <input type='text' name="start_at" class="form-control" value="{{date('d.m.Y H:i', isset($deal->start_at) ? strtotime($deal->start_at) : time())}}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('end_at','Koniec') }}
            <div class='input-group datetimepicker'>
                <input type='text' name="end_at" class="form-control" value="{{date('d.m.Y H:i', isset($deal->end_at) ? strtotime($deal->end_at ) : time()+3600*24)}}"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        @if(isset($deal->image))
            <div class="form-group">
                <div class="announcement-img-wrapper">
                    <img src="{{$deal->getImageSrc()}}" alt="">
                </div>
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('image',isset($deal->image)?'Wybierz nowy obraz (maks. 5MB)' : 'Obraz (maks. 5MB)') }}
            {{ Form::file('image') }}
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="form-group">
            {{ Form::submit(isset($deal) ?'Edytuj':'Dodaj',['class'=>'btn btn-sm btn-primary']) }}
        </div>
    </div>
    <!-- /.box-footer -->
{{ Form::close() }}
