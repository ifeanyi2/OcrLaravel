@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6 m-md-auto">
            <div class="card">
                <div class="card-body shadow-lg">
                   <form method="post" action="{{ route('user.store') }}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                  <div class="text-danger">
                                     {{ $message }}
                                  </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') border-danger @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                            @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') border-danger @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') border-danger @enderror" name="password" id="name" placeholder="Password">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password ">
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Signup</button>
                        </form>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
