@extends('layouts.admin')

@section('title')
    Edit Page Form
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
                                    <form action="{{route('page.update',$pages->id)}}" method="POST">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label for="" class="form-label">Edit Page Position</label>
                                            <select class="form-control" name="edit_page_position" id="">
                                                <option value="1" @if ($pages->page_position == 1) selected @endif>
                                                Line One</option>
                                                <option value="2" @if ($pages->page_position == 2) selected @endif>Line  Two</option>

                                            </select>

                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Edit Page name</label>
                                            <input type="text" class="form-control form-control-lg  @error('edit_page_name') is-invalid @enderror" name="edit_page_name"  value="{{$pages->page_name}}"/>

                                            @error('edit_page_name')
                                            <span class="invalid-feedback"  role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Edit Page Title</label>
                                            <input type="text" class="form-control form-control-lg  @error('edit_page_title') is-invalid @enderror" name="edit_page_title"  value="{{$pages->page_title}}"/>

                                            @error('edit_page_title')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Edit Page Description</label>
                                            <textarea class="form-control summernote @error('edit_page_description') is-invalid @enderror" name="edit_page_description" cols="10" rows="10">
                                                {{$pages->page_description}}
                                            </textarea>
                                            <small>This Data Will show On Your Web Page</small>
                                            
                                            @error('edit_page_description')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Update Page
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
