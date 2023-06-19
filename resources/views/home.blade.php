@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
    <div class="row">
        <div class="col-9 home_left_div p-4">
            <div class="row">
                <h2 class="home_title">
                    Bienvenue <b> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b> ! <i class="fa-thin fa-robot"></i>
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
                    <div class="col-5 home_post m-2">
                        <div class="row m-4">
                            <div class="col-2">
                                <img src="{{ asset('storage/images/users/profile/' . $post->author_image) }}" alt="" class="post_img" style="object-fit: cover;">
                            </div>
                            <div class="col-2">
                                <span class="post_infos_name">{{ $post->first_name }}
                                    <br>
                                    {{ $post->last_name }}
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
                        <div class="row mt-2 justify-content-center">
                            @if ($post->code)
                                <div class="col-10 post_message_area" style="height: 80px; overflow: hidden;">
                                    <span class="text-center">
                                        {!! nl2br(e(Str::limit($post->message, $limit = 100, $end = '...'))) !!}
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
                            <div class="row mt-2 justify-content-center">
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
                                <div class="row mb-5">
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
            </div>
        </div>
        <div class="col-3">
            <div class="row mt-5">
                <h4 class="home_title">Recherche rapide</h4>
                <form action="" method="GET" class="mt-3">
                    <input type="text" name="query" placeholder="Rechercher..." class="search_bar">
                    <button type="submit" class="search_bar_button">Rechercher</button>
                </form>
            </div>
            <div class="row mt-5">
                <div class="col-10 mb-3">
                    <h4 class="home_title">Amis</h4>
                    @foreach($friends as $friend)
                        <div class="d-flex align-items-center mt-3">
                            <img src="{{ asset('storage/images/users/profile/' . $friend->image) }}" alt="" class="profile-picture" style="object-fit: cover;">
                            <div class="ms-2 friends_name">{{ $friend->last_name }} {{ $friend->first_name }} <i class="fa-solid fa-circle"></i></div>
                            <div class="ms-auto friends_icons">
                                <a href="{{ route('user.show', ['user' => $friend->id]) }}">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <i class="fa-solid fa-phone-alt"></i>
                                <i class="fa-solid fa-message"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-10">
                    <h4 class="home_title">Calendrier</h4>
                    <div class="calendar"></div>
                </div>
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
