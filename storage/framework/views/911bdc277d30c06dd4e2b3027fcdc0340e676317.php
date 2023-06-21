<?php use Carbon\Carbon; ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pages/notifications.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5"><i class="fa-solid fa-bell"></i>  Notifications</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php $__currentLoopData = $notifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="badge-item">
                            <div class="row mt-2">
                                <div class="col-auto d-flex align-items-center">
                                    <?php
                                        $imagePath = 'storage/images/users/profile/' . $notification->author_id . '.jpg';
                                        $defaultImagePath = 'storage/images/users/profile/default.jpg';
                                        $imageUrl = asset($imagePath);

                                        if (!file_exists(public_path($imagePath))) {
                                            $imageUrl = asset($defaultImagePath);
                                        }
                                    ?>
                                    <img src="<?php echo e($imageUrl); ?>" alt="" class="post_img" style="object-fit: cover;">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3><?php echo e($notification->message); ?></h3>
                                        <p><?php echo e(Carbon::parse($notification->created_at)->format('d/m/Y H:i')); ?></p>
                                    </div>
                                </div>
                                <?php if($notification->friendship): ?>
                                    <div class="col-auto d-flex align-items-center">
                                        <?php if($notification->confirm != 1): ?>
                                            <a href="#" class="btn btn-success mx-2 btn-circle accept-friendship-btn" data-id="<?php echo e($notification->friendship); ?>" data-notification-id="<?php echo e($notification->id); ?>" title="Accepter l'amitié">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger mx-2 btn-circle reject-friendship-btn" data-id="<?php echo e($notification->friendship); ?>" title="Refuser l'amitié">
                                                <i class="fa-solid fa-times"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <?php $__currentLoopData = $notifications->skip(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="badge-item mt-2">
                            <div class="row">
                                <div class="col-auto d-flex align-items-center">
                                    <?php
                                        $imagePath = 'storage/images/users/profile/' . $notification->author_id . '.jpg';
                                        $defaultImagePath = 'storage/images/users/profile/default.jpg';
                                        $imageUrl = asset($imagePath);

                                        if (!file_exists(public_path($imagePath))) {
                                            $imageUrl = asset($defaultImagePath);
                                        }
                                    ?>
                                    <img src="<?php echo e($imageUrl); ?>" alt="" class="post_img" style="object-fit: cover;">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3><?php echo e($notification->message); ?></h3>
                                        <p><?php echo e($notification->created_at); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.accept-friendship-btn').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var friendshipId = button.data('id');
            var notificationId = button.data('notification-id');

            $.ajax({
                url: '<?php echo e(route("friendship.accept")); ?>',
                method: 'POST',
                data: {
                    friendshipId: friendshipId,
                    notificationId: notificationId,
                    _token: '<?php echo e(csrf_token()); ?>'
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
                url: '<?php echo e(route("friendship.reject")); ?>',
                method: 'POST',
                data: {
                    friendshipId: friendshipId,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    console.log(response);
                    button.hide();
                    button.siblings('.accept-friendship-btn').hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>


<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/user/notifications.blade.php ENDPATH**/ ?>