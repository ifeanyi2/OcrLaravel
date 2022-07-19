@extends('layouts.app')


@section('title', 'Home')
@section('content')


<div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-2"></div>
      <div class="col-sm-12 col-md-8 text-center">
        <img class="img-responsive mt-5" width="400" src="{{ asset('assets/trinity.png') }}" alt=""><br>
        <h2 style="color: navy">Trinity <span class="text-info">OCR</span> Application</h2>
      </div>
      <div class="col-sm-12 col-md-2"></div>
    </div>
</div>

@endsection
