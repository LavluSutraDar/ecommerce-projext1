@extends('layouts.admin')
@section('title')
    Page Index
@endsection

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{route('setting.create.page')}}" class="btn btn-danger">Page Form</a>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All page List here</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>Page Name</th>
                                            <th>Page Title</th>
                                            <th>Page Description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages as $key=>$page)
                                          <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$page->page_name}}</td>
                                            <td>{{$page->page_title}}</td>
                                            <td>
                                                @php
                                                echo $page->page_description;
                                                @endphp
                                            </td>

                                             <td>
                                              <a href="{{route('page.edit',$page->id)}}" class="btn btn-danger btn-lg edit">
                                              <i class="fa-solid fa-pen-to-square"></i>
                                             </a>
                                             </td>

                                             <td>
                                                  <form action="{{route('page.destroy', $page->id)}}"
                                                        method="POST" class="btn btn-danger btn-sm">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="Delete">
                                                        <button type="submit" class="delete btn btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                             </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
