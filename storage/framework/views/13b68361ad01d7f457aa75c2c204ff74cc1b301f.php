<link rel="stylesheet" href="<?php echo e(asset('css/pages/success.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5"><i class="fa-solid fa-trophy"></i> Succès</h1>
        </div>
        <div class="container-fluid rapport_container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php $__currentLoopData = $badges->take(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="badge-item">
                            <div class="row mt-2">
                                <div class="col-auto d-flex align-items-center">
                                    <img src="<?php echo e(asset('images/success/' . $badge->image )); ?>" alt="<?php echo e($badge->name); ?>" class="badge-image">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3><?php echo e($badge->badge); ?></h3>
                                        <p><?php echo e($badge->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-12 col-lg-6">
                    <?php $__currentLoopData = $badges->skip(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="badge-item mt-2">
                            <div class="row">
                                <div class="col-auto d-flex align-items-center">
                                    <img src="<?php echo e(asset('images/success/' . $badge->image )); ?>" alt="<?php echo e($badge->name); ?>" class="badge-image">
                                </div>
                                <div class="col">
                                    <div class="badge-details">
                                        <h3><?php echo e($badge->name); ?></h3>
                                        <p><?php echo e($badge->description); ?></p>
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

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/other/success.blade.php ENDPATH**/ ?>