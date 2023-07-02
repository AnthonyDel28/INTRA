<link rel="stylesheet" href="<?php echo e(asset('css/pages/news.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title p-5 text-light"><i class="fa-solid fa-newspaper"></i> Actualités</h1>
        </div>
        <div class="row">
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 news_field mt-4">
                    <div class="row">
                        <div class="col-2">
                            <?php if(!$new->image): ?>
                                <div class="news_picture" style="background-image: url('<?php echo e(asset('storage/news/default.jpg')); ?>'); background-size: cover;"></div>
                            <?php else: ?>
                                <div class="news_picture" style="background-image: url('<?php echo e(asset('storage/news/' . $new->image)); ?>'); background-size: cover;"></div>
                            <?php endif; ?>
                            <div class="m-4">
                                <span class="text-light news_author">Posté par : <b><?php echo e($new->user_name); ?></b></span><br>
                                <span class="news_date"><?php echo e($new->created_at); ?></span><br>
                                <?php if(in_array(Auth::user()->role_id, [1, 2])): ?>
                                    <form action="<?php echo e(route('news.remove', ['id' => $new->id])); ?>" method="POST" class="delete-news-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-danger delete-news-btn" onclick="confirmDeletion(this)">Supprimer</button>
                                        <button type="submit" class="btn btn-danger delete-news-btn" style="display: none;">Confirmer?</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-8 mb-5">
                            <h4 class="news_title"><?php echo e($new->title); ?></h4>
                            <br>
                            <span class="news_content" style="color: white;"><?php echo html_entity_decode($new->content); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    function confirmDeletion(button) {
        button.style.display = 'none';
        button.nextElementSibling.style.display = 'inline-block';
    }
</script>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/social/news.blade.php ENDPATH**/ ?>