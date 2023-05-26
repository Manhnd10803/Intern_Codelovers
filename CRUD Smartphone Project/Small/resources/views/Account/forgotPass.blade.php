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
            <form action="{{ route('sign-in') }}" method="POST">
                @csrf
                @method('POST')
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                {{-- <p class="lead fw-normal mb-0 me-3">Sign in with</p> --}}
                <h3>FORGOT PASSWORD </h3>
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
                    <input type="text" name="eamil" id="form3Example3" class="form-control form-control-lg"
                        placeholder="Enter a valid email" />
                        @error('eamil')
                            <label class="form-label text-danger" for="form3Example3">{{ $message }}</label>
                        @enderror
                </div>
    
    
                <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Send</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </section>
@endsection