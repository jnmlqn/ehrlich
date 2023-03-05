@extends('layouts.app')
 
@section('content')
    <div class="row justify-content-center">
        <div class="col-9">
            <weather-component city="{{ $city }}"></weather-component>
        </div>
    </div>
@endsection