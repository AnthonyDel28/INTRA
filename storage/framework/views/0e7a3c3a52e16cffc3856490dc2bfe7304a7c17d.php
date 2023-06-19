
<div class="favorite-list-item">
    <?php if($user): ?>
        <div class="avatar av-m" data-id="<?php echo e($user->id); ?>" data-action="0"
             style="background-image: url('<?php echo e(asset('storage/images/users/profile/' . $user->avatar)); ?>');">
        </div>
        <p><?php echo e($user->first_name); ?>

            <br>
            <?php echo e($user->last_name); ?>

        </p>
    <?php endif; ?>
</div>

<?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/vendor/Chatify/layouts/favorite.blade.php ENDPATH**/ ?>