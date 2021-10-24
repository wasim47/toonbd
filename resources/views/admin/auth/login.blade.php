@include('admin.include.app')
<div class="login">
      <div class="login-body">
        <a class="login-brand" href="/" style="background:#fff;">
          <img class="img-responsive" src="{{ url('assets/front/images/logo.jpg')}}" alt="bdicu">
        </a>
        <div class="login-form">
          <form data-toggle="md-validator" method="POST" action="{{ route('adminlogin') }}">
             {{ csrf_field() }}
            <div class="md-form-group md-label-floating">
              <input id="username" type="text" class="md-form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="User ID" 
              name="username" value="{{ old('username') }}" spellcheck="false" autocomplete="off" data-msg-required="Please enter your User ID" required>
              
              <!--<label class="md-control-label">Email</label>-->
            </div>
            <div class="md-form-group md-label-floating">
              <input id="password" type="password" class="md-form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="md-form-group md-custom-controls">
              <label class="custom-control custom-control-primary custom-checkbox">
               <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="custom-control-indicator"></span>
                <label class="custom-control-label" for="remember">
                    {{ __('Keep me signed in') }}
                </label>
              </label>
              <span aria-hidden="true"></span>
              <a href="{{ route('password.request') }}" style="float:right; text-align:right">Forgot password ?</a>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
          </form>
        </div>
      </div>
     
    </div>
