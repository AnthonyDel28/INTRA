@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/show_profile.css') }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
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
                            <span class="btn-text"> En attente</span>
                        </button>
                    @elseif($friendship)
                        <button class="btn mx-2 btn-circle btn-primary" title="Ami ajouté" disabled>
                            <i class="fa-solid fa-user-check"></i>
                            <span class="btn-text"> Ami</span>
                        </button>
                    @else
                        <button class="btn mx-2 btn-circle btn-success add-friend-btn" data-id="{{ $user->id }}" title="Ajouter en ami">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="btn-text"> Ajouter</span>
                        </button>
                    @endif
                </div>
            </div>
            <div class="row mt-3 profile_page_infos @if($user->role_id == 1) background-image-role1 @elseif($user->role_id == 3) background-image-role3 @else background-image-role2 @endif">
                <div class="col-4 col-lg-2">
                    <div class="profile_picture-container">
                        <img src="{{ asset('storage/images/users/profile/' . $user->avatar) }}" alt="" class="profile_picture" id="profileImage">
                    </div>
                </div>
                <div class="col-10 col-lg-10 col-sm-auto">
                    @if($user->role_id == 1)
                        <p class="text-right user_role">Administrateur</p>
                    @elseif($user->role_id == 2)
                        <p class="text-right user_role">Modérateur</p>
                    @else
                        <p class="text-right user_role">Utilisateur</p>
                    @endif
                    <h1 class="profile_main_title mb-0">{{ $user->name }} </h1>
                    <span class="username text-light">{{ $user->first_name }} {{ $user->last_name }}</span><br>
                    <span class="user_level"><b>Niveau {{ $user->level }}</b></span>
                    <div class="range mt-2" style="--p:{{ $user->experience }}">
                        <div class="range__label">Progress</div>
                    </div>
                    <span class="user_experience p-3"><b>{{ $user->experience }}xp / 100xp</b></span>
                    <div class="text-right">
                        @foreach($badges as $badge)
                            <img src="{{ asset('images/success/' . $badge->image) }}" alt="{{ $badge->badge }}" class="badge_img" title="{{ $badge->badge }}">
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="row profile_update_row mt-5">
                <div class="col-12">
                    <h2 class="custom_profile_title">Dernières publications</h2>
                </div>
                @if($posts->isEmpty())
                    <p class="text-light">Aucune publication</p>
                @else
                    @foreach ($posts as $post)
                        <div class="col-5 home_post m-3">
                            <div class="row m-4">
                                <div class="col-2">
                                    <img src="{{ asset('storage/images/users/profile/' . $post->author_image) }}" alt="" class="post_img" style="object-fit: cover;">
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
                                        {!! nl2br(htmlspecialchars(substr($post->title, 0, 70) . (strlen($post->title) > 70 ? '...' : ''))) !!}
                                    </span>
                                </div>
                            </div>
                            <div class="row like_row justify-content-end" style="justify-content: flex-end;">
                                <div class="col-4 text-center">
                                    <span class="like_text">
                                        <span id="likeCount_{{ $post->post_id }}" class="like_value like_count">{{ $post->likes }}</span>
                                        j'aime
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                @if ($post->code)
                                    <div class="col-10 post_message_area" style="height: 85px; overflow: hidden;">
                                        <span class="text-center">
                                            {!! nl2br(htmlspecialchars(substr($post->message, 0, 150) . (strlen($post->message) > 100 ? '...' : ''))) !!}
                                        </span>
                                    </div>
                                @else
                                    <div class="col-10 post_message_area" style="height: 180px; overflow: hidden;">
                                        <span class="text-center">
                                           {!! nl2br(htmlspecialchars(substr($post->message, 0, 400) . (strlen($post->message) > 400 ? '...' : ''))) !!}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    document.querySelectorAll('pre code').forEach((el) => {
                                        hljs.highlightElement(el);
                                    });
                                });
                            </script>
                            @if ($post->code)
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-10 post_message_area">
                                        <pre>
                                            <code class="language-{{ $post->language }}" id="code_insert">
                                        {!! htmlspecialchars(nl2br(substr($post->code, 0, 150))) !!}{{ strlen($post->code) > 150 ? '...' : '' }}
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            @endif
                            <div class="row justify-content-center mt-4">
                                <div class="col-10 post_actions">
                                    <div class="row">
                                        <div class="col-6 text-center">
                                             <span class="like_button" id="likeButton_{{ $post->post_id }}" data-postid="{{ $post->post_id }}">
                                                    @if ($post->isLiked)
                                                     <i class="fa-solid fa-thumbs-down"></i>
                                                     <span class="like_text">Je n'aime plus</span>
                                                 @else
                                                     <i class="fa-solid fa-thumbs-up"></i>
                                                     <span class="like_text">J'aime</span>
                                                 @endif
                                            </span>
                                        </div>
                                        <div class="col-6 text-center">
                                            <span class="action_post" onclick="showPostDetails({{ $post->post_id }})">
                                                <i class="fa-brands fa-readme"></i> Lire le post
                                            </span>
                                            <script>
                                                function showPostDetails(postId) {
                                                    window.location.href = '/posts/' + postId;
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.like_button').each(function() {
            var likeButton = $(this);
            var postId = likeButton.data('postid');
            var likeCountElement = $('#likeCount_' + postId);
            var likeTextElement = likeButton.find('.like_text');

            likeButton.click(function() {
                $.ajax({
                    url: '{{ url("/posts/like") }}',
                    method: 'POST',
                    data: {
                        postId: postId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            var likeCount = parseInt(likeCountElement.text());
                            var likeText = likeTextElement.text();

                            if (likeText === 'Je n\'aime plus') {
                                likeCount--;
                                likeTextElement.text('J\'aime');
                                likeButton.find('i').removeClass('fa-thumbs-down').addClass('fa-thumbs-up');
                            } else {
                                likeCount++;
                                likeTextElement.text('Je n\'aime plus');
                                likeButton.find('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-down');
                            }
                            likeCountElement.text(likeCount);
                        }
                    }
                });
            });
        });
    });

</script>
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
<script>
    $(document).ready(function() {

        $('.btn-waiting').addClass('btn-primary');

        $('.add-friend-btn').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var userId = button.data('id');

            if (button.find('.btn-text').text() === ' Ajouter') {
                $.ajax({
                    url: '/add-friend',
                    method: 'POST',
                    data: {
                        userId: userId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        button.find('.btn-text').text(' En attente');
                        button.addClass('btn-primary').removeClass('btn-success');
                        button.prop('disabled', true);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else if (button.find('.btn-text').text() === ' En attente') {
                $.ajax({
                    url: '/remove-friend',
                    method: 'POST',
                    data: {
                        userId: userId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        button.find('.btn-text').text(' Ajouter');
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


