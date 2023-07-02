<link rel="stylesheet" href="<?php echo e(asset('css/pages/snake.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5 text-light"><i class="fa-solid fa-trophy"></i> Classement du jeu Snake</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>Position</th>
                        <th>Joueur</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $scores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($key == 0): ?>
                                    <i class="fa-solid fa-trophy gold"></i>
                                <?php elseif($key == 1): ?>
                                    <i class="fa-solid fa-trophy silver"></i>
                                <?php elseif($key == 2): ?>
                                    <i class="fa-solid fa-trophy bronze"></i>
                                <?php else: ?>
                                    <?php echo e($key + 1); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($score->username); ?></td>
                            <td><?php echo e($score->score); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/games/snakeScores.blade.php ENDPATH**/ ?>