@extends('layouts.app')
 
@section('content')
    <div class="row justify-content-center">
        <div class="col-9">
            <home-component user="{{ auth()->user() }}"></home-component>
        </div>
    </div>
@endsection