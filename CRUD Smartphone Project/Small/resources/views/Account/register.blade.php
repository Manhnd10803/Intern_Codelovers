@extends('index')
@section('content')
<section class="vh-100">
        <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="{{ route('sign-up') }}" method="POST">
                @csrf
                @method('POST')
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                {{-- <p class="lead fw-normal mb-0 me-3">Sign in with</p> --}}
                <h3>SIGN UP</h3>
                {{-- <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>
    
                <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>
    
                <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-linkedin-in"></i>
                </button> --}}
                </div>
    
                <div class="divider d-flex align-items-center my-4">
                {{-- <p class="text-center fw-bold mx-3 mb-0">Or</p> --}}
                <p class="text-center fw-bold mx-3 mb-0">M</p>
                </div>
    
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" name="email" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" />
                    @error('email')
                        <label class="form-label text-danger" for="form3Example3">{{ $message }}</label>
                    @enderror
                </div>
    
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" name="name" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a valid account name" />
                    @error('name')
                        <label class="form-label text-danger" for="form3Example3">{{ $message }}</label>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" />
                    @error('password')
                        <label class="form-label text-danger" for="form3Example3">{{ $message }}</label>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" name="confirm_password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" />
                    @error('confirm_password')
                        <label class="form-label text-danger" for="form3Example3">{{ $message }}</label>
                    @enderror
                </div>
    
                <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Sign up</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Have you registered ?<a href="{{ route('sign-in') }}"
                    class="link-danger">Login</a></p>
                </div>
    
            </form>
            </div>
        </div>
        </div>
    </section>
@endsection