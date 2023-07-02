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
                            <div class="news_picture" style="background-image: url('{{ asset('storage/news/' . $new->image) }}'); background-size: cover;"></div>
                            <div class="m-4">
                                <span class="text-light news_author">Posté par : <b>{{ $new->user_name }}</b></span><br>
                                <span class="news_date">{{ $new->created_at }}</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <h4 class="news_title">{{ $new->title }}</h4>
                            <br>
                            <p>{{ $new->content }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

