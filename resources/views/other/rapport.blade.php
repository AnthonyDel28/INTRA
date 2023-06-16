@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/rapport.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <h1 class="main_title p-5"><i class="fa-solid fa-bug"></i> Signaler un bug</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-md-6 p-5 form_rapport_container">
                    <form action="{{ route('other.rapport') }}" method="POST">
                        @csrf
                        <div class="form-group rapport_form">
                            <label for="title" class="rapport_form_label">Titre :</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group rapport_form">
                            <label for="message">Message :</label>
                            <textarea name="message" id="message" class="form-control" rows="10" required></textarea>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <button type="submit" class="rapport_btn">Soumettre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

