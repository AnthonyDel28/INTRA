<link rel="stylesheet" href="<?php echo e(asset('css/pages/show.css')); ?>">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<?php $__env->startSection('content'); ?>
    <div id="app" class="post-page">
      <?php
      dd($users);
      ?>
    </div>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/search/results.blade.php ENDPATH**/ ?>