
<div class="favorite-list-item">
    @if($user)
        <div class="avatar av-m" data-id="{{ $user->id }}" data-action="0"
             style="background-image: url('{{ asset('storage/images/users/profile/' . $user->avatar) }}');">
        </div>
        <p>{{ $user->first_name  }}
            <br>
            {{ $user->last_name }}
        </p>
    @endif
</div>

