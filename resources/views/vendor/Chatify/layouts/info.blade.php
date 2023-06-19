{{-- user info and avatar --}}
<div class="avatar chatify-d-flex"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Supprimer la discussion</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Photos partagées</span></p>
    <div class="shared-photos-list"></div>
</div>
