<?php
    $userId = request()->route('id'); // Récupérer l'ID de l'utilisateur à partir de la route
    $user = null;

    if ($userId) {
        $user = DB::table('users')->where('id', $userId)->first();
    }
?>
<div class="avatar av-l chatify-d-flex"></div>
<?php if($user): ?>
    <?php if(Auth()->user()->dark_mode == 0): ?>
        <h2 class="info-name text-center text-dark" style="font-weight: bold;"><b><?php echo e($user->name); ?></b></h2>
    <?php else: ?>
        <h2 class="info-name text-center text-light" style="font-weight: bold;"><b><?php echo e($user->name); ?></b></h2>
    <?php endif; ?>
<?php endif; ?>

<div class="messenger-infoView-btns">
    <a href="#" class="danger delete-conversation">Supprimer la discussion</a>
</div>


<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Photos partagées</span></p>
    <div class="shared-photos-list"></div>
</div>
<?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/vendor/Chatify/layouts/info.blade.php ENDPATH**/ ?>