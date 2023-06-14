@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/profile.css') }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row profile_page_infos mt-5 @if($user->role_id == 1) background-image-role1 @elseif($user->role_id == 3) background-image-role3 @endif">
                <div class="col-4 col-lg-2">
                    <img src="{{ asset('storage/images/users/profile/' . Auth::user()->image) }}" alt="" class="profile_picture">
                </div>
                <div class="col-10 col-lg-10 col-sm-auto">
                    <p class="text-right user_role">{{ $user->role }}</p>
                    <h1 class="profile_main_title">{{ $user->last_name }} {{ $user->first_name }}</h1>
                    <span class="user_level"><b>Niveau {{ $user->level }}</b></span>
                    <div class="range mt-2" style="--p:{{ $user->experience }}">
                        <div class="range__label">Progress</div>
                    </div>
                    <span class="user_experience p-3"><b>{{ $user->experience }}xp / 100xp</b></span>
                </div>
            </div>
            <hr>
            <div class="row profile_update_row mt-5">
                <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}" required>

                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" required>

                    <label for="last_name">Nom de famille</label>
                    <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password">

                    <label for="gender">Genre</label>
                    <select id="gender" name="gender">
                        <option value="/">Non spécifié</option>
                        <option value="M" {{ $user->gender === 'M' ? 'selected' : '' }}>Masculin</option>
                        <option value="F" {{ $user->gender === 'F' ? 'selected' : '' }}>Féminin</option>
                    </select>

                    <label for="image">Image</label>
                    <input type="file" id="image" name="image">

                    <button type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
