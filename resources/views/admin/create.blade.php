<div class="box box-primary">
    {{ Form::open(['route' => 'admin.register']) }}
        <div class="box-header with-border">
            <h3 class="box-title">Dodaj administratora:</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @csrf
            <div class="form-group">
                {{ Form::label('email','Adres email:') }}
                {{ Form::email('email','',['class'=>'form-control']) }}
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
</div>

