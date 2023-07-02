@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/snake.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5 text-light"><i class="fa-solid fa-trophy"></i> Classement du jeu Snake</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>Position</th>
                        <th>Joueur</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($scores as $key => $score)
                        <tr>
                            <td>
                                @if($key == 0)
                                    <i class="fa-solid fa-trophy gold"></i>
                                @elseif($key == 1)
                                    <i class="fa-solid fa-trophy silver"></i>
                                @elseif($key == 2)
                                    <i class="fa-solid fa-trophy bronze"></i>
                                @else
                                    {{ $key + 1 }}
                                @endif
                            </td>
                            <td>{{ $score->username }}</td>
                            <td>{{ $score->score }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
