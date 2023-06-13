@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
    <div class="row">
        <div class="col-9 home_left_div p-4">
            <div class="row">
                <h2 class="home_title">
                    Bienvenue <b>{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</b> ! <i class="fa-thin fa-robot"></i>
                </h2>
            </div>
            <div class="row">
                <div class="col-7 home_main_picture p-0 m-3">
                    <img src="{{ asset('images/assets/intraheader.png') }}" alt="">
                </div>
            </div>
            <div class="row mt-5">
                <h3 class="home_title">Dernières publications</h3>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <!-- <a href="{{ route('posts.show', $post->post_id) }}" > -->
                    <div class="col-5 home_post m-3">
                        <div class="row m-4">
                            <div class="col-2">
                                <img src="{{ asset('images/users/profile/' . $post->author_image) }}" alt="" class="post_img">
                            </div>
                            <div class="col-2">
                                <span class="post_infos_name">{{ $post->last_name }}
                                <br>
                                {{ $post->first_name }}
                                    <br>
                                  <span class="post_infos_date">
                                       {{ \Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i') }}
                                  </span>
                                </span>
                            </div>
                            <div class="col-8 justify-content-center">
                                <span class="text-center post_infos_title">
                                    {{ $post->title }}
                                </span>
                            </div>
                        </div>
                        <div class="row like_row justify-content-end" style="justify-content: flex-end;">
                            <div class="col-4 text-center">
                                    <span class="like_text">
                                         <span class="like_value">{{ $post->likes }}</span>
                                        j'aime
                                    </span>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-10 post_message_area" style="height: 90px;">
                                <span class="text-center">
                                    {{ Str::limit($post->message, $limit = 150, $end = '...') }}
                                </span>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', (event) => {
                                document.querySelectorAll('pre code').forEach((el) => {
                                    hljs.highlightElement(el);
                                });
                            });
                        </script>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-10 post_message_area">
                                <pre>
                                    <code class="language-javascript">
                                        {!! Str::limit(nl2br($post->code), $limit = 150, $end = '...') !!}
                                    </code>
                                </pre>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-8 post_actions">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        @if ($post->isLikedByUser) <!-- Vérifier si l'utilisateur a déjà aimé le post -->
                                        <span class="like_button liked" data-postid="{{ $post->post_id }}">
                        <i class="fa-solid fa-thumbs-up"></i> {{ $post->post_id }}
                    </span>
                                        @else
                                            <span class="like_button" data-postid="{{ $post->post_id }}">
                        <i class="fa-solid fa-thumbs-up"></i> {{ $post->post_id }}
                    </span>
                                        @endif
                                    </div>
                                    <div class="col-6 text-center">
                                            <span class="action_post">
                                                <i class="fa-brands fa-readme"></i> Lire le post
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-3">
            <div class="row mt-5">
                <h4 class="home_title">Recherche rapide</h4>
                <form action="{{ route('publish') }}" method="GET" class="mt-3">
                    <input type="text" name="query" placeholder="Rechercher..." class="search_bar">
                    <button type="submit" class="search_bar_button">Rechercher</button>
                </form>
            </div>
            <div class="row mt-5 ">
                <div class="col-10 mb-3">
                    <h4 class="home_title">Amis</h4>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Stefan Toader <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Eva Maudoux <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Pierre Hardy <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="profile-picture">
                        <div class="ms-2 friends_name">Sylvain Piefort <i class="fa-solid fa-circle"></i></div>
                        <div class="ms-auto friends_icons">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-phone-alt"></i>
                            <i class="fa-solid fa-message"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-10">
                    <h4 class="home_title">Notifications</h4>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Capturer le clic sur le bouton "J'aime"
        $('.like_button').click(function() {
            var postId = $(this).data('postid'); // Récupérer l'ID du post
            var likeCountElement = $(this).closest('.home_post').find('.like_value');

            // Afficher le postId dans la console pour le débogage
            console.log(postId);

            // Effectuer la requête AJAX
            $.ajax({
                url: '/posts/like',
                method: 'POST',
                data: {
                    postId: postId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var currentLikes = parseInt(likeCountElement.text());
                    likeCountElement.text(currentLikes + 1);
                },
                error: function(xhr, status, error) {
                    console.log('Erreur lors de la requête AJAX');
                }
            });
        });
    });

</script>
