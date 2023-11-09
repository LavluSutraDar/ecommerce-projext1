@extends('layouts.admin')

@section('title')
    Website Setting
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
                            <li class="breadcrumb-item active">Website Setting</li>
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
                                    <h2 class="text-uppercase text-center mb-5">Website Setting</h2>
                                    <form action="{{route('website.update', $websites->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Meta Currency</label>
                                           <select name="currency" class="form-control">
                                            <option selected disabled value="৳">Chose Option</option>
                                               <option value="৳" {{ ($websites->currency == '৳') ? 'selected': '' }}>TAKA</option>
                                               <option value="$" {{ ($websites->currency == '$') ? 'selected': '' }}>USD</option>
                                           </select>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Number One</label>
                                            <input type="text" class="form-control form-control-lg" name="phone_one" value="{{$websites->phone_one}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Number Two</label>
                                            <input type="text" class="form-control form-control-lg" name="phone_two" value="{{$websites->phone_two}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Main Email</label>
                                            <input type="email" class="form-control form-control-lg" name="main_email" value="{{$websites->main_email}}"/>
                                          
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Sapport Email</label>
                                            <input type="email" class="form-control form-control-lg" name="support_email" value="{{$websites->support_email}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control form-control-lg" name="address" value="{{$websites->address}}"/>
                                        </div>

                                        <strong class="text-danger">Social Link</strong>

                                         <div class="form-outline mb-4">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" class="form-control form-control-lg" name="facebook" value="{{$websites->facebook}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" class="form-control form-control-lg" name="twitter" value="{{$websites->twitter}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" class="form-control form-control-lg" name="instagram" value="{{$websites->instagram}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Linkedin</label>
                                            <input type="text" class="form-control form-control-lg" name="linkedin" value="{{$websites->linkedin}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Youtube</label>
                                            <input type="text" class="form-control form-control-lg" name="youtube" value="{{$websites->youtube}}"/>
                                        </div>

                                        <strong class="text-danger">Logo & Favicon</strong>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Main Logo</label>
                                            <input type="file" class="form-control form-control-lg" name="logo"/>
                                            <input type="hidden" class="form-control form-control-lg" name="old_logo" value="{{$websites->logo}}"/>

                                        </div>

                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Favicon</label>
                                            <input type="file" class="form-control form-control-lg" name="fav_icon"/>
                                            <input type="hidden" class="form-control form-control-lg" name="old_fav_icon" value="{{$websites->fav_icon}}"/>

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
