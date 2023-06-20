
<?php if(Auth()->user()->dark_mode == 0): ?>
    <h1 class="info-name text-center text-dark"><b><?php echo e(config('chatify.name')); ?></b></h1>
<?php else: ?>
    <h1 class="info-name text-center text-light"><b><?php echo e(config('chatify.name')); ?></b></h1>
<?php endif; ?>
<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Supprimer la discussion</a>
</div>

<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Photos partagées</span></p>
    <div class="shared-photos-list"></div>
</div>
<?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/vendor/Chatify/layouts/info.blade.php ENDPATH**/ ?>