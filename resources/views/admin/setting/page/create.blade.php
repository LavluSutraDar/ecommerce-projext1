@extends('layouts.admin')

@section('title')
    Page Form
@endsection

@section('admin_content')
    <div class="content-wrapper">
        <section class="vh-100 bg-image">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <form action="{{ route('page.store') }}" method="POST">
                                        @csrf

                                        <div class="form-outline mb-4">
                                            <label for="" class="form-label">Page Position</label>
                                            <select class="form-control" name="page_position" id="">
                                                <option value="1">Line One</option>
                                                <option value="2">Line  Two</option>

                                            </select>

                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Page name</label>
                                            <input type="text" class="form-control form-control-lg  @error('page_name') is-invalid @enderror" name="page_name" />

                                            @error('page_name')
                                            <span class="invalid-feedback"  role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Page Title</label>
                                            <input type="text" class="form-control form-control-lg  @error('page_title') is-invalid @enderror" name="page_title" />

                                            @error('page_title')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Page Description</label>
                                            <textarea class="form-control summernote @error('page_description') is-invalid @enderror" name="page_description" cols="10" rows="10">
                                            </textarea>
                                            <small>This Data Will show On Your Web Page</small>
                                            
                                            @error('page_description')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Create Page
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </iv>
    @endsection
