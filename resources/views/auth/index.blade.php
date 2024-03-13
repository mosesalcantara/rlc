@extends('sections.auth.layout')

@section('title', 'Login')
 
@section('links')
    @parent
@endsection
 
@section('content')
  <section class="vh-100" style="background-image: url({{ asset('img/auth/bg.jpg') }});">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-flex picture align-items-center justify-content-center">
                <img src="{{ asset('img/auth/logo.png') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="/auth/login" method="post">
                    
                    @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Sign in to your account</span>
                    </div>

                    <div class="form-floating mb-4">
                      <input type="email" id="email" name='email' class="form-control form-control-lg" />
                      <label class="form-label" for="email">Email address</label>
                    </div>

                    <div class="form-floating mb-4">
                      <input type="password" id="password" name="password" class="form-control form-control-lg" />
                      <label class="form-label" for="password">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <input type="submit" class="btn btn-dark btn-lg btn-block" value="Login">
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-3 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/auth/register"
                      style="color: #393f81;">Register here</a></p>
                    <a href="#!" class="small text-muted">Terms of use.</a>
                    <a href="#!" class="small text-muted">Privacy policy</a>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
    @parent
@endsection