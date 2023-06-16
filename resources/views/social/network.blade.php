@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/network.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5"><i class="fa-solid fa-network-wired"></i> Network</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <!-- Afficher l'utilisateur connecté en premier -->
                    <div class="badge-item">
                        <div class="row mt-2">
                            <div class="col-auto d-flex align-items-center">
                                <img src="{{ asset('storage/images/users/profile/' . Auth::user()->image ) }}" alt="{{ Auth::user()->username }}" class="badge-image">
                            </div>
                            <div class="col">
                                <div class="badge-details">
                                    <h3>{{ Auth::user()->username }}</h3>
                                    <span>{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Afficher les autres utilisateurs -->
                    @foreach($users->take(6) as $user)
                        @if($user->id !== Auth::user()->id)
                            <div class="badge-item">
                                <div class="row mt-2">
                                    <div class="col-auto d-flex align-items-center">
                                        <img src="{{ asset('storage/images/users/profile/' . $user->image ) }}" alt="{{ $user->username }}" class="badge-image">
                                    </div>
                                    <div class="col">
                                        <div class="badge-details">
                                            <h3>{{ $user->username }}</h3>
                                            <span>{{ $user->last_name }} {{ $user->first_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center badge-actions">
                                        <a href="" class="btn btn-success mx-2 btn-circle" title="Ajouter en ami">
                                            <i class="fa-solid fa-user-plus"></i> Ajouter
                                        </a>
                                        <a href="" class="btn btn-success btn-circle" title="Envoyer un message">
                                            <i class="fa-solid fa-envelope"></i> Contacter
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-12 col-lg-6">
                    <!-- Afficher les autres utilisateurs -->
                    @foreach($users->skip(6) as $user)
                        @if($user->id !== Auth::user()->id)
                            <div class="badge-item">
                                <div class="row mt-2">
                                    <div class="col-auto d-flex align-items-center">
                                        <img src="{{ asset('storage/images/users/profile/' . $user->image ) }}" alt="{{ $user->username }}" class="badge-image">
                                    </div>
                                    <div class="col">
                                        <div class="badge-details">
                                            <h3>{{ $user->username }}</h3>
                                            <p>{{ $user->last_name }} {{ $user->first_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <a href="" class="btn btn-success mx-2 btn-circle" title="Ajouter en ami">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </a>
                                        <a href="" class="btn btn-primary btn-circle" title="Envoyer un message">
                                            <i class="fa-solid fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
