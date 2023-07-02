@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/results.css') }}">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div id="app" class="post-page">
        <div class="container-fluid">
            <div class="row">
                <h1 class="main_title"><i class="fa-solid fa-magnifying-glass"></i> Résultats de la recherche</h1>
                <hr>
            </div>
            @if($users->isNotEmpty())
                <div class="row mt-5">
                    <h3 class="result_main_title"><i class="fa-solid fa-user"></i> Utilisateurs</h3>
                    <hr>
                </div>
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-xl-4 col-6 search_user_field mb-4" onclick="redirectToProfile('{{ $user->id }}')">
                            <img src="{{ asset('storage/images/users/profile/' . $user->avatar) }}" alt="" class="user_img">
                            <span class="user_name">{{ $user->name }}</span>
                        </div>
                    @endforeach
                    <script>
                        function redirectToProfile(userId) {
                            window.location.href = "/profile/" + userId;
                        }
                    </script>
                </div>
            @else
                <div class="col-6">
                    <div class="row mt-5">
                        <h3 class="result_main_title"><i class="fa-solid fa-user"></i> Utilisateurs</h3>
                        <hr style="width: 90%;">
                    </div>
                    <div class="row">
                        <span class="text-light">Aucun utilisateur</span>
                    </div>
                </div>
            @endif
            <div class="row justify-content-between">
                @if($posts->isNotEmpty())
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title"><i class="fa-solid fa-newspaper"></i> Publications</h3>
                            <hr style="width: 90%;">
                        </div>
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="search_post_field col-10 m-3">
                                    <div class="row justify-content-center">
                                        <div class="col-10 m-3">
                                            <img src="{{ asset('storage/images/users/profile/' . $post->avatar) }}" alt="" class="user_img">
                                            <span class="post_title">{{ $post->name }}</span>
                                            <div class="col-6 mt-3">
                                                <span class="post_date">Publié le {{ $post->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <p class="text-light">
                                                {{ nl2br(e(substr($post->message, 0, 200))) }} ...
                                            </p>
                                        </div>
                                    </div>=
                                </div>
                                <div class="col-2"></div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title"><i class="fa-solid fa-newspaper"></i> Publications</h3>
                            <hr style="width: 90%;">
                        </div>
                        <div class="row">
                            <span class="text-light">Aucune publication</span>
                        </div>
                    </div>
                @endif

                @if($comments->isNotEmpty())
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title">Commentaires</h3>
                            <hr>
                        </div>
                        <div class="row">
                            @foreach($comments as $comment)
                                <div class="search_post_field col-10 m-3" onclick="redirectToPost('{{ $comment->post_id }}', '{{ $comment->comment_id }}')">
                                    <script>
                                        function redirectToPost(postId, commentId) {
                                            window.location.href = "/posts/" + postId + "#comment-" + commentId;
                                        }
                                    </script>
                                    <div class="row justify-content-center">
                                        <div class="col-10 m-3">
                                            <img src="{{ asset('storage/images/users/profile/' . $comment->avatar) }}" alt="" class="user_img">
                                            <span class="post_title">{{ $comment->name }}</span>
                                            <div class="col-6 mt-3">
                                                <span class="post_date">Publié le {{ $comment->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <p class="text-light">{{ $comment->message }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title">Commentaires</h3>
                            <hr>
                        </div>
                        <div class="row">
                            <span class="text-light">Aucun commentaire</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

