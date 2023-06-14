@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="post_title"> {{ $post->title }}</h1>
        </div>
        <div class="row post_author_infos justify-content-evenly">
            <div class="col-12">
                <span class="author_date">Publié le {{ \Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i') }} par</span>
                <br>
                <img src="{{ asset('images/users/profile/default.jpg') }}" alt="" class="author_img mt-3" style="width: 40px; height: 40px;">
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
            <div class="col-4">
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
    {!! htmlspecialchars($post->code, ENT_QUOTES, 'UTF-8', false) !!}
</code>
                       </pre>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
