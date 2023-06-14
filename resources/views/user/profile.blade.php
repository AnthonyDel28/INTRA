@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/profile.css') }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row profile_page_infos mt-5 @if($user->role_id == 1) background-image-role1 @elseif($user->role_id == 3) background-image-role3 @endif">
                <div class="col-4 col-lg-2">
                    <div class="profile_picture-container">
                        <img src="{{ asset('storage/images/users/profile/' . Auth::user()->image) }}" alt="" class="profile_picture" id="profileImage">
                        <div class="profile_picture-overlay" id="profileOverlay">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
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
                <div class="col-12">
                    <h2 class="custom_profile_title">Modifier votre profil</h2>
                </div>
                <div class="col-12">
                    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        @method('PUT')

                        <div class="row update_form">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="username">Nom d'utilisateur</label><br>
                                        <input type="text" id="username" name="username" value="{{ $user->username }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="first_name">Prénom</label><br>
                                        <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="last_name">Nom de famille</label><br>
                                        <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Email</label><br>
                                        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="password">Mot de passe</label><br>
                                        <input type="password" id="password" name="password">
                                    </div>
                                    <div class="col-6">
                                        <label for="gender">Genre</label><br>
                                        <select id="gender" name="gender">
                                            <option value="/">Non spécifié</option>
                                            <option value="M" {{ $user->gender === 'M' ? 'selected' : '' }}>Masculin</option>
                                            <option value="F" {{ $user->gender === 'F' ? 'selected' : '' }}>Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-5">
                                    <div class="col-4">
                                        <button type="submit">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="image" name="image" style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileOverlay = document.getElementById('profileOverlay');
        const imageInput = document.getElementById('image');
        const profileForm = document.getElementById('profileForm');

        profileOverlay.addEventListener('click', function() {
            imageInput.click();
        });

        imageInput.addEventListener('change', function() {
            profileForm.submit();
        });
    });
</script>
