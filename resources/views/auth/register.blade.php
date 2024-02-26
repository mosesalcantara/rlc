@extends('sections.auth.layout')

@section('title', 'Register')
 
@section('links')
    @parent
@endsection
 
@section('content')
    <!-- <h1>Register</h1>

    @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/auth/register" method="post">
        @csrf
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="password_confirmation">
        </div>
        <div>
            <input type="submit" value="Register">
            <button><a href="/auth">Login</a></button>
        </div>
    </form> -->

    <section class="vh-100" style="background-color: #9A616D;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
              
                  <div class="card-body p-4 p-lg-5 text-black">
                    <form action="/auth/register" method="post">
                      
                      @csrf
                      <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Logo</span>
                      </div>
    
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register your account</h5>

                      <div class="form-floating mb-4">
                        <input type="text" id="name" name='name' class="form-control form-control-lg" />
                        <label class="form-label" for="name">Name</label>
                      </div>
    
                      <div class="form-floating mb-4">
                        <input type="email" id="email" name='email' class="form-control form-control-lg" />
                        <label class="form-label" for="email">Email address</label>
                      </div>
    
                      <div class="form-floating mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                      </div>

                      <div class="form-floating mb-4">
                        <input type="password" id="password_confirmation" name='password_confirmation' class="form-control form-control-lg" />
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                      </div>
    
                      <div class="pt-1 mb-4">
                        <input type="submit" class="btn btn-dark btn-lg btn-block" value="Register">
                      </div>
    
                      <p class="mb-3 pb-lg-2" style="color: #393f81;">Already have an account? <a href="/auth"
                        style="color: #393f81;">Login here</a></p>
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