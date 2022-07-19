@extends('admin.layouts.template')


@section('title', 'Dashboard')
@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h2>{{ auth()->user()->name }}</h2>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th>SCHOOL</th>
                        <td>{{ $get_school->name }}</td>
                    </tr>
                    <tr>
                        <th>MOTTO</th>
                        <td>{{ $get_school->motto }}</td>
                    </tr>
                    <tr>
                        <th>HEAD</th>
                        <td>{{ $get_school->head }}</td>
                    </tr>
                </table>
                <div class="card-footer">
                    <p><strong>School Website: </strong>{{ $get_school->website }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-5"></div>
    </div>
</div>

@endsection
