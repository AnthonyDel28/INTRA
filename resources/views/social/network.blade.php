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
                                        @php
                                            $friendship = DB::table('friendships')
                                                ->where(function ($query) use ($user) {
                                                    $query->where('user_id', Auth::user()->id)
                                                        ->where('friend_id', $user->id);
                                                })
                                                ->orWhere(function ($query) use ($user) {
                                                    $query->where('user_id', $user->id)
                                                        ->where('friend_id', Auth::user()->id);
                                                })
                                                ->first();
                                        @endphp
                                        @if($friendship && $friendship->confirm == 0)
                                            <button class="btn mx-2 btn-circle btn-waiting" title="En attente" disabled>
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text">En attente</span>
                                            </button>
                                        @elseif($friendship)
                                            <button class="btn mx-2 btn-circle btn-primary" title="Ami ajouté" disabled>
                                                <i class="fa-solid fa-user-check"></i>
                                                <span class="btn-text"> Ami</span>
                                            </button>
                                        @else
                                            <button class="btn mx-2 btn-circle btn-success add-friend-btn" data-id="{{ $user->id }}" title="Ajouter en ami">
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text">Ajouter</span>
                                            </button>
                                        @endif
                                        <a href="#" class="btn btn-success btn-circle" title="Envoyer un message">
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
                                            <span>{{ $user->last_name }} {{ $user->first_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center badge-actions">
                                        @php
                                            $friendship = DB::table('friendships')
                                                ->where(function ($query) use ($user) {
                                                    $query->where('user_id', Auth::user()->id)
                                                        ->where('friend_id', $user->id);
                                                })
                                                ->orWhere(function ($query) use ($user) {
                                                    $query->where('user_id', $user->id)
                                                        ->where('friend_id', Auth::user()->id);
                                                })
                                                ->first();
                                        @endphp
                                        @if($friendship && $friendship->confirm == 0)
                                            <button class="btn mx-2 btn-circle btn-waiting" title="En attente" disabled>
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text">En attente</span>
                                            </button>
                                        @elseif($friendship)
                                            <button class="btn mx-2 btn-circle btn-primary" title="Ami ajouté" disabled>
                                                <i class="fa-solid fa-user-check"></i>
                                                <span class="btn-text"> Ami</span>
                                            </button>
                                        @else
                                            <button class="btn mx-2 btn-circle btn-success add-friend-btn" data-id="{{ $user->id }}" title="Ajouter en ami">
                                                <i class="fa-solid fa-user-plus"></i>
                                                <span class="btn-text">Ajouter</span>
                                            </button>
                                        @endif
                                        <a href="#" class="btn btn-success btn-circle" title="Envoyer un message">
                                            <i class="fa-solid fa-envelope"></i> Contacter
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('.btn-waiting').addClass('btn-primary');

        $('.add-friend-btn').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var userId = button.data('id');

            if (button.find('.btn-text').text() === 'Ajouter') {
                $.ajax({
                    url: '/add-friend',
                    method: 'POST',
                    data: {
                        userId: userId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        button.find('.btn-text').text('En attente');
                        button.addClass('btn-primary').removeClass('btn-success');
                        button.prop('disabled', true);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else if (button.find('.btn-text').text() === 'En attente') {
                $.ajax({
                    url: '/remove-friend',
                    method: 'POST',
                    data: {
                        userId: userId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        button.find('.btn-text').text('Ajouter');
                        button.removeClass('btn-primary').addClass('btn-success');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });
</script>
