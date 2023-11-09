@extends('layouts.admin')

@section('title')
    SEO Setting
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
                            <li class="breadcrumb-item active">SEO Setting</li>
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
                                    <h2 class="text-uppercase text-center mb-5">SEO Setting</h2>
                                    <form action="{{ route('setting.seo.update', $data->id) }}" method="POST">
                                        @csrf

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Meta Title</label>
                                            <input type="text" class="form-control form-control-lg" name="meta_title" value="{{$data->meta_title}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Meta Author</label>
                                            <input type="text" class="form-control form-control-lg" name="meta_author" value="{{$data->meta_author}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Meta Tag</label>
                                            <input type="text" class="form-control form-control-lg" name="meta_tag" value="{{$data->meta_tag}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Meta Description</label>
                                             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="meta_description" value="{{$data->meta_description}}">

                                             </textarea>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Meta Keyword</label>
                                            <small>Example :E-Commerce -> Online shop Online -> Market</small>
                                            <input type="text" class="form-control form-control-lg" name="meta_keyword" value="{{$data->meta_keyword}}"/>
                                            
                                        </div>

                                        <strong class="text-center text-yellow">------Other Option-----</strong>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Google Verification	</label>
                                            <input type="text" class="form-control form-control-lg" name="google_verification" value="{{$data->google_verification}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Google Analytics</label>
                                            <input type="text" class="form-control form-control-lg" name="google_analytics" value="{{$data->google_analytics}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Alexa Verification</label>
                                            <input type="text" class="form-control form-control-lg" name="alexa_verification" value="{{$data->alexa_verification}}"/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cdg">Google Adsense</label>
                                            <input type="text" class="form-control form-control-lg" name="google_adsense" value="{{$data->google_adsense}}"/>
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
