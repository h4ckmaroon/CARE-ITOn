@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.notif')
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'register-user']) !!}
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <center>
                                    <img class="img-responsive" id="tech-pic" src="" style="max-width:150px; background-size: contain" />
                                </center>
                                <center>
                                    {!! Form::label('pic', 'User Picture') !!}
                                    {!! Form::file('photo',[
                                        'class' => 'form-control',
                                        'name' => 'photo',
                                        'class' => 'btn btn-success btn-sm',
                                        'onchange' => 'readURL(this)']) 
                                    !!}
                                </center>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('username', 'Username') !!}<span>*</span>
                                    {!! Form::input('text','username',null,[
                                        'class' => 'form-control',
                                        'id' => 'username',
                                        'placeholder'=>'Username',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('cpassword', 'Confirm Password') !!}<span>*</span>
                                    {!! Form::input('password','cpassword',null,[
                                        'class' => 'form-control',
                                        'id' => 'cpassword',
                                        'placeholder'=>'Confirm Password',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('firstName', 'First Name') !!}<span>*</span>
                                    {!! Form::input('text','firstName',null,[
                                        'class' => 'form-control',
                                        'id' => 'firstname',
                                        'placeholder'=>'First Name',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('middleName', 'Middle Name') !!}
                                    {!! Form::input('text','middleName',null,[
                                        'class' => 'form-control',
                                        'id' => 'middleName',
                                        'placeholder'=>'Middle Name',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('lastName', 'Last Name') !!}<span>*</span>
                                    {!! Form::input('text','lastName',null,[
                                        'class' => 'form-control',
                                        'id' => 'lastName',
                                        'placeholder'=>'Last Name',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('contactNo', 'Contact No.') !!}<span>*</span>
                                    {!! Form::input('text','contactNo',null,[
                                        'class' => 'form-control',
                                        'id' => 'contactNo',
                                        'placeholder'=>'Contact No.',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}<span>*</span>
                                    {!! Form::input('text','email',null,[
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'placeholder'=>'Email',
                                        'maxlength'=>'50']) 
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('accountNo', 'Account No. (UnionBank)') !!}<span>*</span>
                                    {!! Form::input('text','accountNo',null,[
                                        'class' => 'form-control',
                                        'id' => 'accountNo',
                                        'placeholder'=>'Account No.',
                                        'maxlength'=>'12']) 
                                    !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Register', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#email').inputmask("email");
        $('#contactNo').inputmask("(9999) 999-9999");
        $('#accountNo').inputmask("999999999999");
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tech-pic')
                    .attr('src', e.target.result)
                    .width(180);
                };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection