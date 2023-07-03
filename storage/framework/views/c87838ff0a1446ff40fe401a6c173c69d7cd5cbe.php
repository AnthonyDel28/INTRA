<link rel="stylesheet" href="<?php echo e(asset('css/pages/results.css')); ?>">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<?php $__env->startSection('content'); ?>
    <?php
        use Illuminate\Support\Str;
    ?>
    <div id="app" class="post-page">
        <div class="container-fluid">
            <div class="row">
                <h1 class="main_title"><i class="fa-solid fa-magnifying-glass"></i> Résultats de la recherche</h1>
                <hr>
            </div>
            <?php if($users->isNotEmpty()): ?>
                <div class="row mt-5">
                    <h3 class="result_main_title"><i class="fa-solid fa-user"></i> Utilisateurs</h3>
                    <hr>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4 col-6 search_user_field mb-4" onclick="redirectToProfile('<?php echo e($user->id); ?>')">
                            <img src="<?php echo e(asset('storage/images/users/profile/' . $user->avatar)); ?>" alt="" class="user_img">
                            <span class="user_name"><?php echo e($user->name); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <script>
                        function redirectToProfile(userId) {
                            window.location.href = "/profile/" + userId;
                        }
                    </script>
                </div>
            <?php else: ?>
                <div class="col-6">
                    <div class="row mt-5">
                        <h3 class="result_main_title"><i class="fa-solid fa-user"></i> Utilisateurs</h3>
                        <hr style="width: 90%;">
                    </div>
                    <div class="row">
                        <span class="text-light">Aucun utilisateur</span>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-between">
                <?php if($posts->isNotEmpty()): ?>
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title"><i class="fa-solid fa-newspaper"></i> Publications</h3>
                            <hr style="width: 90%;">
                        </div>
                        <div class="row">
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="search_post_field col-10 m-3" onclick="redirectToPost('<?php echo e($post->post_id); ?>')">
                                    <script>
                                        function redirectToPost(postId) {
                                            window.location.href = "/posts/" + postId;
                                        }
                                    </script>
                                    <div class="row justify-content-center">
                                        <div class="col-10 m-3">
                                            <img src="<?php echo e(asset('storage/images/users/profile/' . $post->avatar)); ?>" alt="" class="user_img">
                                            <span class="post_title"><?php echo e($post->name); ?></span>
                                            <div class="col-6 mt-3">
                                                <span class="post_date">Publié le <?php echo e($post->created_at); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <p class="text-light">
                                                <?php echo e(nl2br(e(substr($post->message, 0, 200)))); ?> ...
                                            </p>
                                        </div>
                                    </div>=
                                </div>
                                <div class="col-2"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title"><i class="fa-solid fa-newspaper"></i> Publications</h3>
                            <hr style="width: 90%;">
                        </div>
                        <div class="row">
                            <span class="text-light">Aucune publication</span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($comments->isNotEmpty()): ?>
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title">Commentaires</h3>
                            <hr>
                        </div>
                        <div class="row">
                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="search_post_field col-10 m-3" onclick="redirectToPost('<?php echo e($comment->post_id); ?>', '<?php echo e($comment->comment_id); ?>')">
                                    <script>
                                        function redirectToPost(postId, commentId) {
                                            window.location.href = "/posts/" + postId + "#comment-" + commentId;
                                        }
                                    </script>
                                    <div class="row justify-content-center">
                                        <div class="col-10 m-3">
                                            <img src="<?php echo e(asset('storage/images/users/profile/' . $comment->avatar)); ?>" alt="" class="user_img">
                                            <span class="post_title"><?php echo e($comment->name); ?></span>
                                            <div class="col-6 mt-3">
                                                <span class="post_date">Publié le <?php echo e($comment->created_at); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-10">
                                            <p class="text-light"><?php echo e($comment->message); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-6">
                        <div class="row mt-5">
                            <h3 class="result_main_title">Commentaires</h3>
                            <hr>
                        </div>
                        <div class="row">
                            <span class="text-light">Aucun commentaire</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/search/results.blade.php ENDPATH**/ ?>