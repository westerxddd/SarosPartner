<div class="box box-saros">
    {{ Form::open(['route' => 'users.invite']) }}
    <div class="box-header with-border">
        <h3 class="box-title">Wyślij ponownie zaproszenie:</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @csrf
        <div class="form-group">
            {{ Form::hidden('client', $client->id) }}
            {{ Form::hidden('resend', 1) }}
        </div>
        <div class="form-group">
            {{ Form::label('email','Adres email:') }}
            {{ Form::email('email',$client->user->email,['class'=>'form-control']) }}
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <div class="form-group">
            {{ Form::submit('Wyślij ponownie',['class'=>'btn btn-sm btn-primary']) }}
        </div>
    </div>
    <!-- /.box-footer -->
    {{ Form::close() }}
</div>

