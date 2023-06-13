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
                                    <span id="likeCount_{{ $post->post_id }}" class="like_value">{{ $post->likes }}</span>
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
                            <div class="col-10 post_actions">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <span class="like_button" id="likeButton_{{ $post->post_id }}" data-postid="{{ $post->post_id }}" data-liked="{{ $post->isLiked }}" @click="switchLike({{ $post->post_id }})">
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

    </div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
        // Capturer le clic sur le bouton "J'aime"
        $('.like_button').click(function() {
            var postId = $(this).data('postid'); // Récupérer l'ID du post
            var likeCountElement = $(this).closest('.home_post').find('.like_value');

            // Effectuer la requête AJAX
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
                        likeCountElement.text(response.likes);
                    }
                },
            });
        });
    });

    const app = Vue.createApp({
        methods: {
            switchLike(postId) {
                const likeButton = document.getElementById(`likeButton_${postId}`);
                const likeCountElement = document.getElementById(`likeCount_${postId}`);
                const likeText = likeButton.querySelector('.like_text');
                const isLiked = likeButton.dataset.liked;

                axios.post('/posts/like', { postId: postId })
                    .then(response => {
                        if (response.data.success) {
                            // Mettre à jour le texte du bouton en fonction de la réponse
                            if (isLiked === 'true') {
                                likeText.innerHTML = '<i class="fa-solid fa-thumbs-up"></i> J\'aime';
                                likeButton.dataset.liked = 'false';
                                likeCountElement.textContent = parseInt(likeCountElement.textContent) - 1;
                            } else {
                                likeText.innerHTML = '<i class="fa-solid fa-thumbs-down"></i> Je n\'aime plus';
                                likeButton.dataset.liked = 'true';
                                likeCountElement.textContent = parseInt(likeCountElement.textContent) + 1;
                            }

                            // Mettre à jour les données réactives de la vue
                            this.posts = this.posts.map(post => {
                                if (post.post_id === postId) {
                                    return {
                                        ...post,
                                        isLiked: !post.isLiked,
                                        likes: response.data.likes
                                    };
                                }
                                return post;
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
        }

        }

    });


    app.mount('#app');

</script>
