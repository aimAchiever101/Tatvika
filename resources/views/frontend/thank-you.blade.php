@extends('layouts.app')

@section('title','thank you for Shopping with us') 

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if(session('message'))
                    <h5 class="alert">{{ session('message') }}</h5>
                @endif
                <div class="p-4 shadow bg-white">
                    <h2>Tatvika</h2>
                    <h4>Thank you for Shopping with Tatvika. </h4>
                    <a href="{{url('collections')}}" class="btn btn-primary">SHop now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection