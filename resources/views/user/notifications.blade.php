@extends('layouts.app_layout')
@php use Carbon\Carbon; @endphp
<link rel="stylesheet" href="{{ asset('css/pages/notifications.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5"><i class="fa-solid fa-trophy"></i> Succès</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    @foreach($notifications->take(10) as $notification)
                        <div class="badge-item">
                            <div class="row mt-2">
                                <div class="col-auto d-flex align-items-center">
                                    @php
                                        $imagePath = 'storage/images/users/profile/' . $notification->author_id . '.jpg';
                                        $defaultImagePath = 'storage/images/users/profile/default.jpg';
                                        $imageUrl = asset($imagePath);

                                        if (!file_exists(public_path($imagePath))) {
                                            $imageUrl = asset($defaultImagePath);
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="" class="post_img" style="object-fit: cover;">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3>{{ $notification->message }}</h3>
                                        <p>{{ Carbon::parse($notification->created_at)->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    @if ($notification->confirm != 1)
                                        <a href="#" class="btn btn-success mx-2 btn-circle accept-friendship-btn" data-id="{{ $notification->friendship }}" title="Accepter l'amitié">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger mx-2 btn-circle reject-friendship-btn" data-id="{{ $notification->friendship }}" title="Refuser l'amitié">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 col-lg-6">
                    @foreach($notifications->skip(10) as $notification)
                        <div class="badge-item mt-2">
                            <div class="row">
                                <div class="col-auto d-flex align-items-center">
                                    @php
                                        $imagePath = 'storage/images/users/profile/' . $notification->author_id . '.jpg';
                                        $defaultImagePath = 'storage/images/users/profile/default.jpg';
                                        $imageUrl = asset($imagePath);

                                        if (!file_exists(public_path($imagePath))) {
                                            $imageUrl = asset($defaultImagePath);
                                        }
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="" class="post_img" style="object-fit: cover;">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3>{{ $notification->message }}</h3>
                                        <p>{{ $notification->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.accept-friendship-btn').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var friendshipId = button.data('id');

            $.ajax({
                url: '{{ route("friendship.accept") }}',
                method: 'POST',
                data: {
                    friendshipId: friendshipId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    // Masquer les boutons accepter et refuser
                    button.hide();
                    button.siblings('.reject-friendship-btn').hide();
                    // Ici, vous pouvez effectuer d'autres actions après avoir accepté l'amitié
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('.reject-friendship-btn').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var friendshipId = button.data('id');

            $.ajax({
                url: '{{ route("friendship.reject") }}',
                method: 'POST',
                data: {
                    friendshipId: friendshipId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    // Masquer les boutons accepter et refuser
                    button.hide();
                    button.siblings('.accept-friendship-btn').hide();
                    // Ici, vous pouvez effectuer d'autres actions après avoir refusé l'amitié
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

