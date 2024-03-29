@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/friends.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5 text-light"><i class="fa-solid fa-users"></i> Amis</h1>
        </div>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-5 col-10 home_post m-2">
                    <div class="row m-4">
                        <div class="col-2">
                            <img src="{{ asset('storage/images/users/profile/' . $post->avatar) }}" alt="" class="post_img" style="object-fit: cover;">
                        </div>
                        <div class="col-lg-2 col-8">
                                <span class="post_infos_name">{{ $post->first_name }}
                                    <br>
                                    {{ $post->last_name }}
                                    <br>
                                  <span class="post_infos_date">
                                       {{ \Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i') }}
                                  </span>
                                </span>
                        </div>
                        <div class="col-10 col-lg-8 justify-content-center">
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
                    <div class="row mt-2 justify-content-center">
                        @if ($post->code)
                            <div class="col-10 post_message_area" style="height: 80px; overflow: hidden;">
                                    <span class="text-center">
                                       {!! nl2br(htmlspecialchars(substr($post->message, 0, 100) . (strlen($post->message) > 100 ? '...' : ''))) !!}
                                    </span>
                            </div>
                        @else
                            <div class="col-10 post_message_area" style="height: 180px; overflow: hidden;">
                                    <span class="text-center">
                                      {!! nl2br(htmlspecialchars(substr($post->message, 0, 400) . (strlen($post->message) > 100 ? '...' : ''))) !!}

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
                                          {!! htmlspecialchars(nl2br(substr($post->code, 0, 150))) !!}{{ strlen($post->code) > 150 ? '...' : '' }}
                                        </code>
                                    </pre>
                            </div>
                        </div>
                    @endif
                    <div class="row justify-content-center mt-4">
                        <div class="col-10 post_actions">
                            <div class="row mb-5">
                                <div class="col-10 col-md-6 col-xl-6 text-center mt-3">
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
                                <div class="col-10 col-md-6 col-xl-6 text-center mt-3">
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
