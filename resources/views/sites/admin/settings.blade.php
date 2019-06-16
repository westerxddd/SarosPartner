<div class="col-lg-4">
    <div class="box box-saros">
        <div class="box-header with-border">
            <h3 class="box-title">Dodaj konto administratora</h3>
        </div>
        <!-- /.box-header -->
        {{ Form::open(['route' => ['users.store',$user->id]]) }}
        <div class="box-body">
            @csrf
            {{ Form::hidden('admin',1)}}
            <div class="form-group">
                {{ Form::label('name','Nazwa:') }}
                {{ Form::text('name','',['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email','Adres email:') }}
                {{ Form::email('email','',['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('password','Hasło do konta:') }}
                {{ Form::password('password',['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('confirm_password','Potwierdź hasło:') }}
                {{ Form::password('confirm_password',['class'=>'form-control']) }}
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
</div>
@if(count($admins)>0)
    <div class="col-lg-4">
        <div class="box box-saros">
            <div class="box-header with-border">
                <h3 class="box-title">Konta administratorów</h3>
            </div>
            <!-- /.box-header -->
            {{ Form::open(['route' => ['users.store',$user->id]]) }}
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
