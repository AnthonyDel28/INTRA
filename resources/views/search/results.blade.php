@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/show.css') }}">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
@section('content')
    <div id="app" class="post-page">
      @php
      dd($users);
      @endphp
    </div>
