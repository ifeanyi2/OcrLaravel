@extends('admin.layouts.template')


@section('title', 'Settings')
@section('content')

<div class="container">

    <h1>Site Settings</h1>
    <div class="row">
        <hr color="purple">
        <div class="col-md-12">
            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Change Password</h2>
                    <form action="" method="POST" class="form">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Passwsord">
                        </div>
                        <div class="mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm New Password">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>
</div>


@endsection
