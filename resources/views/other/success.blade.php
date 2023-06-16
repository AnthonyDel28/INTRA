@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/success.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5"><i class="fa-solid fa-trophy"></i> Succès</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    @foreach($badges->take(7) as $badge)
                        <div class="badge-item">
                            <div class="row mt-2">
                                <div class="col-auto d-flex align-items-center">
                                    <img src="{{ asset('images/success/' . $badge->image ) }}" alt="{{ $badge->name }}" class="badge-image">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3>{{ $badge->badge }}</h3>
                                        <p>{{ $badge->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 col-lg-6">
                    @foreach($badges->skip(7) as $badge)
                        <div class="badge-item mt-2">
                            <div class="row">
                                <div class="col-auto d-flex align-items-center">
                                    <img src="{{ asset('images/success/' . $badge->image ) }}" alt="{{ $badge->name }}" class="badge-image">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3>{{ $badge->name }}</h3>
                                        <p>{{ $badge->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
