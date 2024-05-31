<!-- resources/views/home.blade.php -->


@extends('app')

@section('title', 'Home')

@section('content')
<section class="px-4">
    <div class="container-fluid">
        <div class="py-2 px-4">
            <div class="row ">
                <div class="col d-flex flex-column align-items-center">
                <h3 class="row ">Welcome to</h3>
                <h2 class="row ">Taxopti</h2>
                <h2 class="row">Making Taxes Easy</h2>
                <p class="row py-1">Your Taxes matters. Complete your Tax Filing, Simply !</p>
                <a class="btn btn-primary"">Request a Call</a>
                </div>
                <div class="col">
                    Harsh
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-between">
    <x-card></x-card>
    <x-card></x-card>
    <x-card></x-card>
    </div>
    <div class="container-fluid">
        <x-callback></x-callback>
    </div>
</section>
@endsection