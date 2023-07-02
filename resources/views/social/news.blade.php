@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/news.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5 text-light"><i class="fa-solid fa-newspaper"></i> Actualités</h1>
        </div>
        <div class="row">
            @foreach($news as $new)
                <div class="col-12 news_field mt-4">
                    <div class="row">
                        <div class="col-2">
                            @if(!$new->image)
                                <div class="news_picture" style="background-image: url('{{ asset('storage/news/default.jpg') }}'); background-size: cover;"></div>
                            @else
                                <div class="news_picture" style="background-image: url('{{ asset('storage/news/' . $new->image) }}'); background-size: cover;"></div>
                            @endif
                            <div class="m-4">
                                <span class="text-light news_author">Posté par : <b>{{ $new->user_name }}</b></span><br>
                                <span class="news_date">{{ $new->created_at }}</span><br>
                                @if(in_array(Auth::user()->role_id, [1, 2]))
                                    <form action="{{ route('news.remove', ['id' => $new->id]) }}" method="POST" class="delete-news-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger delete-news-btn" onclick="confirmDeletion(this)">Supprimer</button>
                                        <button type="submit" class="btn btn-danger delete-news-btn" style="display: none;">Confirmer?</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="col-8 mb-5">
                            <h4 class="news_title">{{ $new->title }}</h4>
                            <br>
                            <span class="news_content" style="color: white;">{!! html_entity_decode($new->content) !!}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<script>
    function confirmDeletion(button) {
        button.style.display = 'none';
        button.nextElementSibling.style.display = 'inline-block';
    }
</script>
