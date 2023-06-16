@extends('index')
@section('javascript')
    <script>
        function validate(){
            let password = document.querySelector('#password').value;
            let confirm_password = document.querySelector('#confirm_password').value;
            let error_password = document.querySelector('.error_password');
            let error_confirm_password = document.querySelector('.error_confirm_password');
            let check = true;
            if(password == ''){
                error_password.innerHTML = 'Bạn cần nhập'
                check = false
            }else{
                error_password.innerHTML = ''
            }
            if(confirm_password == ''){
                error_confirm_password.innerHTML = 'Bạn cần nhập'
                check = false
            }else if(confirm_password !== password){
                error_confirm_password.innerHTML = 'Mật khẩu nhập lại không khớp'
                check = false
            }else{
                error_confirm_password.innerHTML = ''
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
            <form action="{{ route('post-mat-khau-moi') }}" method="POST">
                @csrf
                @method('POST')
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                {{-- <p class="lead fw-normal mb-0 me-3">Sign in with</p> --}}
                <h3>NEW PASS</h3>
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

                <input type="hidden" name="id" value="{{ $id }}">
                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" name="password" id="password" class="form-control form-control-lg"
                        placeholder="Enter new password" />
                    <label class="form-label text-danger error_password" for="password"></label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg"
                        placeholder="Enter confirm new password" />
                    <label class="form-label text-danger error_confirm_password" for="confirm_password"></label>
                </div>
    
                <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;" onclick="return validate()">Submit</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </section>
@endsection