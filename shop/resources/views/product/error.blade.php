@extends('layouts.app')
@section('content')
    <div class="alert alert-danger text-center">
        <h1>{{ $msg }}</h1>
    </div>
    <div class="text-center">
        <a class="btn btn-primary" href="/">回上一頁</a>
    </div>
@endsection