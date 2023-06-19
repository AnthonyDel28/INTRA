@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/show_profile.css') }}">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row profile_page_infos @if($user->role_id == 1) background-image-role1 @elseif($user->role_id == 3) background-image-role3 @endif">
                <div class="col-4 col-lg-2">
                    <div class="profile_picture-container">
                        <img src="{{ asset('storage/images/users/profile/' . $user->image) }}" alt="" class="profile_picture" id="profileImage">
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
                                        {!! Str::limit(htmlspecialchars(nl2br($post->title)), $limit = 70, $end = '...') !!}
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
                                            {!! nl2br(e(Str::limit($post->message, $limit = 150, $end = '...'))) !!}
                                        </span>
                                    </div>
                                @else
                                    <div class="col-10 post_message_area" style="height: 180px; overflow: hidden;">
                                        <span class="text-center">
                                            {!! nl2br(e(Str::limit($post->message, $limit = 400, $end = '...'))) !!}
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
                                                {!! Str::limit(htmlspecialchars(nl2br($post->code)), $limit = 150, $end = '...') !!}
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



