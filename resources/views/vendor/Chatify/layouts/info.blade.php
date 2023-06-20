
@if(Auth()->user()->dark_mode == 0)
    <h1 class="info-name text-center text-dark"><b>{{ config('chatify.name') }}</b></h1>
@else
    <h1 class="info-name text-center text-light"><b>{{ config('chatify.name') }}</b></h1>
@endif
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Supprimer la discussion</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Photos partagées</span></p>
    <div class="shared-photos-list"></div>
</div>
