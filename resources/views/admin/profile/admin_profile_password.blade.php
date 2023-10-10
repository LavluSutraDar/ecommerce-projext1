@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Password change</li>
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
              <h2 class="text-uppercase text-center mb-5">Change your Password</h2>

              <form action="{{route('admin.password.update')}}" method="POST">
                @csrf
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Current Password</label>
                  <input type="password" class="form-control form-control-lg" name="current_password" value=""/>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">New Password</label>
                  <input type="password" class="form-control form-control-lg @error('new_password') is-invalid @enderror" name="password"/>
                  
                  @error('new_password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cdg">Confirm password</label>
                  <input type="password"  class="form-control form-control-lg" name="password_confirmation"/>
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
