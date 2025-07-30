 <div class="mb-3">
     <label for="email" class="form-label">{{ __('E-Mail Address / Mobile') }}</label>
     <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id=" email" placeholder="Enter your mobile or email" aria-describedby="emailHelp" value="{{ old('email') }}" required autocomplete="email" autofocus>
     @error('email')
     <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
     </span>
     @enderror
 </div>
 <div class="mb-3 position-relative">
     <label for="password" class="form-label">Password</label>
     <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter you password" id="password" required autocomplete="current-password">
     <i onclick="TogglePassLogin()" class="far fa-eye" id="togglePassword" style="position:absolute; z-index:99; cursor: pointer; right:9px; bottom:8px"></i>
     @error('password')
     <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
     </span>
     @enderror
 </div>
 <div class="row">
     <div class="col">
         <div class="mb-3 form-check">
             <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
             <label class="form-check-label" for="remember">
                 {{ __('Remember Me') }}
             </label>
         </div>

     </div>
     <div class="col text-right">
         @if (Route::has('hostpassword.request'))
         <a href="{{ route('hostpassword.request') }}" class="text-org"> {{ __('Forgot Your Password?') }}</a>
         @endif
     </div>
 </div>
 <div class="d-grid gap-2">
     <button type="submit" class="btn wed-btn-main no-shadow"> {{ __('Sign in') }}</button>
 </div>

 <p class="text-center continue-txt"><span class="continue">or continue with</span></p>

 <div class="row my-3">
     <div class="col-12 col-sm-6 col-md-6">
         <div class="d-grid gap-2">
             <a href="{{ route('fblogin') }}" class="btn btn-primary btn-sm fb-btn">
                 Sign in with Facebook
             </a>
         </div>
     </div>
     <div class="col-12 col-sm-6 col-md-6">
         <div class="d-grid gap-2">
             <a href="{{ route('googleLogin') }}" class="btn btn-primary btn-sm g-btn">
                 Sign in with Google
             </a>
         </div>
     </div>
 </div>
