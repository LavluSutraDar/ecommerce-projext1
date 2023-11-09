@extends('layouts.admin')

@section('title')
    SMTP Setting
@endsection

@section('admin_content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Admin Dashboard</a></li>
                        <h1 class="m-0"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">SMTP Mail Setting</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="vh-100 bg-image">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">SMTP Mail Setting</h2>
                                    <form action="{{route('setting.smtp.update',$smtp->id)}}" method="POST">
                                        @csrf

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Mail Mailer</label>
                                            <input type="text" class="form-control form-control-lg" name="mailer" value="{{$smtp->mailer}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Mail Host</label>
                                            <input type="text" class="form-control form-control-lg" name="host" value="{{$smtp->host}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Mail Port</label>
                                            <input type="text" class="form-control form-control-lg" name="port" value="{{$smtp->port}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Mail User name</label>
                                            <input type="text" class="form-control form-control-lg" name="user_name" value="{{$smtp->user_name}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Mail Password</label>
                                            <input type="password" class="form-control form-control-lg" name="password" value="{{$smtp->password}}"/>
                                        </div>


                                        
                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
