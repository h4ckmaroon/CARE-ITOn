@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('layouts.notif')
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    {!! Form::open(['url' => 'login']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('username', 'Username') !!}<span>*</span>
                                    {!! Form::input('text','username',null,[
                                        'class' => 'form-control',
                                        'id' => 'username',
                                        'placeholder'=>'Username',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('password', 'Password') !!}<span>*</span>
                                    {!! Form::input('password','password',null,[
                                        'class' => 'form-control',
                                        'id' => 'password',
                                        'placeholder'=>'Password',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Login', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
