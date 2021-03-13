@extends('layouts.AuthTemplate')
@section('pageTitle')
<title>Se connecté</title>
@endsection
@section('content')

    <div class="card card-shadowed p-50 w-400 mb-0 " style="max-width: 100%;background-color:rgb(250, 255, 250)">
      <h5 class="text-uppercase text-center">Se connecté</h5>

      <div class="divider"></div>

      <form method="POST" action="{{route('login')}}">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Username" name="username">
          @error('username')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
        </div>

        <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="divider"></div>

        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" type="submit">Se connecté</button>
        </div>
      </form>



      {{-- <p class="text-center text-muted fs-13 mt-20">Vous n'avez pas un compte? <a href="{{route('register')}}" class="btn btn-outline-success">S'inscrire</a></p> --}}
    </div>

@endsection
