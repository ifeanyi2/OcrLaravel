@extends('layouts.app')



@section('title', 'Login')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 m-md-auto">
            <div class="card">
                @if(session('status'))
                   <p class="text-danger text-center m-2">{{ session('status') }}</p>

                @endif
                <div class="card-body shadow-lg">
                   <form method="post" action="{{ route('login.user') }}">
                    @csrf

                        <div class="form-group">
                            <label for="login">User</label>
                            <input type="text" class="form-control @error('login') border-danger @enderror" name="login" id="email" placeholder="User" value="{{ old('login') }}">
                            @error('login')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') border-danger @enderror" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me.
                                </label>
                            </div>
                        </div>




                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
