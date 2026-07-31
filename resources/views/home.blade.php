@extends('layouts.app')

@section('title', 'Accueil - GlowShop')

@section('content')
    @auth
        @include('components.welcome-user')
        @include('components.products', ['products' => $products])
        @include('components.categories')
    @endauth

    @guest
        @include('components.hero')
        @include('components.products', ['products' => $products])
    @endguest
@endsection
