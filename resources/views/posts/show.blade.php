@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
@section('content')
    <div id="app" class="post-page">
        <div class="post_zone">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="post_title"> {{ $post->title }}</h1>
                </div>
                <div class="row post_author_infos justify-content-evenly">
                    <div class="col-12">
                        <span class="author_date">Publié le {{ \Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i') }} par</span>
                        <br>
                        <img src="{{ asset('storage/images/users/profile/' . $post->author_image) }}" alt="" class="author_img mt-3" style="width: 40px; height: 40px; object-fit: cover;">
                        <span class="author_name">{{ $post->last_name }} {{ $post->first_name }}</span>
                    </div>
                </div>
                <div class="row mt-5">
                    <span class="category">
                        <b>Catégorie: </b> {{ $post->section_name }}
                    </span>
                </div>
                <div class="row mt-3">
                    @if($post->code)
                        <div class="col-5">
                            @else
                                <div class="col-7">
                                    @endif
                                    <h5 class="section_title">Message</h5>
                                    <div class="message_area p-5">
                                        {!! nl2br(e($post->message)) !!}
                                    </div>
                                </div>
                                @if($post->code)
                                    <div class="col-7">
                                        <h5 class="section_title">Code</h5>
                                        <div class="message_area p-5">
                                <pre class="code_area">
                                    <code class="language-{{ $post->language }}" id="code_insert">
                                        {!! str_replace(['{', '}'], '{', htmlspecialchars($post->code, ENT_QUOTES, 'UTF-8')) !!}
                                    </code>
                                </pre>
                                        </div>
                                    </div>
                                @endif
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                        <span class="like_row">
                            <b id="likeCount">{{ $likes }}</b> j'aime
                            @if(!$isLiked)
                                <i class="fa-solid fa-thumbs-up like_button"></i>
                            @else
                                <i class="fa-solid fa-thumbs-down like_button liked"></i>
                            @endif
                        </span>
                            </div>
                            <div class="col-6 text-end">
                                <div>
                                    <button class="comment_button"  id="showComment">Publier un commentaire</button>
                                </div>
                                @if(auth()->user()->id === $post->author || auth()->user()->role_id === 1)
                                    <form id="deleteForm" action="{{ route('posts.delete', ['postId' => $post->post_id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mt-3">
                                            <button type="button" class="delete_button" id="deletePostButton">Supprimer ce post</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <hr style="width: 80%;">
            </div>
            <div class="container-fluid">
                <div class="row m-2">
                    <h3 class="comment_title">Commentaires</h3>
                </div>
            </div>
            <div id="comment-overlay" class="col-6 p-5">
                <div class="comment-content comment-form">
                    <h2 class="form_comment_title text-center">Ajouter un commentaire</h2>
                    <form action="{{ route('comments.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="message" style="color: #00A3FF;">Message</label>
                            <textarea class="form-control comment_message_area" id="message" name="message" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="code" style="color: #00A3FF;">Code</label>
                            <textarea class="form-control comment_code_area" id="code" name="code" rows="5"></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                        <div class="row justify-content-center">
                            <div class="col-4 text-center">
                                <button type="submit" class="comment_button">Ajouter le commentaire</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach($comments as $comment)
                <div class="row m-3">
                    <div class="col-12 comment_zone p-5" id="comment-{{ $comment->id }}">
                        <div class="row post_author_infos justify-content-evenly">
                            <div class="col-12">
                                <img src="{{ asset('storage/images/users/profile/' . $comment->user_image) }}" alt="" class="author_img mt-3" style="width: 40px; height: 40px; object-fit: cover;">
                                <span class="author_name">{{ $comment->last_name }} {{ $comment->first_name }}</span>
                            </div>
                        </div>
                        <div class="row comment_content">
                            @if($comment->code)
                                <div class="col-4 comment_message mt-4">
                                    @else
                                        <div class="col-10 comment_message mt-4">
                                            @endif
                                            <div class="message_area p-5">
                                                {!! nl2br(e($comment->message)) !!}
                                            </div>
                                        </div>
                                        @if($comment->code)
                                            <div class="col-8 comment_code">
                                <pre class="comment_code_content">
                                    <code class="language-{{ $post->language }}" id="code_insert">
                                        {!! htmlspecialchars($comment->code, ENT_QUOTES, 'UTF-8') !!}
                                    </code>
                                </pre>
                                            </div>
                                        @endif
                                </div>
                                <div class="row mt-4">
                                    <span class="author_date">Publié le {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i') }} </span>
                                </div>
                        </div>
                    </div>
                    @endforeach
                    @if(session()->has('success_comment'))
                        <div class="success_div" id="success_div">
                            <div class="success_message">
                                <div class="row justify-content-end">
                                    <i class="fa-solid fa-circle-xmark text-right" id="closeSuccess"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <img src="{{ asset('images/gifs/success.svg') }}" alt="" class="success_image">
                                    <h4 class="success_title text-center mt-2">Commentaire ajouté avec succès</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endsection

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var deleteButton = $('#deletePostButton');
                        var deleteForm = $('#deleteForm');

                        deleteButton.click(function() {
                            if (deleteButton.text() === "Supprimer ce post") {
                                deleteButton.text("Confirmer?");
                            } else {
                                deleteForm.submit();
                            }
                        });

                        $('.like_button').click(function() {
                            var likeButton = $(this);
                            var likeCountElement = $('#likeCount');

                            $.ajax({
                                url: '{{ url("/post/like") }}',
                                method: 'POST',
                                data: {
                                    postId: {{ $post->post_id }},
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.success) {
                                        var likeCount = parseInt(likeCountElement.text());

                                        if (likeButton.hasClass('liked')) {
                                            likeCount--;
                                            likeButton.removeClass('liked');
                                            likeButton.removeClass('fa-thumbs-down').addClass('fa-thumbs-up');
                                        } else {
                                            likeCount++;
                                            likeButton.addClass('liked');
                                            likeButton.removeClass('fa-thumbs-up').addClass('fa-thumbs-down');
                                        }
                                        likeCountElement.text(likeCount);
                                    }
                                }
                            });
                        });

                        $('#showComment').click(function() {
                            $('#comment-overlay').toggle();
                        });
                        $('#closeSuccess').click(function() {
                            $('#success_div').hide();
                        });
                    });
                </script>
