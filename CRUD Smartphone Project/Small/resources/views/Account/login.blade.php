@extends('index')
@section('javascript')
<script>
    function validate(){
        let username = document.querySelector('#username').value;
        let password = document.querySelector('#password').value;
        let error_username = document.querySelector('.error_username');
        let error_password = document.querySelector('.error_password');
        let check = true;
        if(username == ''){
            error_username.innerHTML = 'Bạn cần nhập'
            check = false
        }else{
            error_username.innerHTML = ''
        }
        if(password == ''){
            error_password.innerHTML = 'Bạn cần nhập'
            check = false
        }else{
            error_password.innerHTML = ''
        }
        return check;
    }
</script>
@endsection
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
            <h3>SIGN IN</h3>
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

            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" name="name" id="username" class="form-control form-control-lg"
                    placeholder="Enter a valid account name" />
                    <label class="form-label text-danger error_username" for="username"></label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" name="password" id="password" class="form-control form-control-lg"
                    placeholder="Enter password" />
                <label class="form-label text-danger error_password" for="password"></label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                Remember me
                </label>
            </div>
            <a href="{{ route('forgot-pass') }}" class="text-body">Forgot password?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="return validate()">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('sign-up') }}"
                class="link-danger">Register</a></p>
            </div>
        </form>
        </div>
    </div>
    </div>
</section>
@endsection