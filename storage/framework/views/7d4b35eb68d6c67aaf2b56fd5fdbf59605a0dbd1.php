<link rel="stylesheet" href="<?php echo e(asset('css/pages/show.css')); ?>">
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<?php $__env->startSection('content'); ?>
    <div id="app" class="post-page">
        <div class="post_zone">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="post_title"> <?php echo e($post->title); ?></h1>
                </div>
                <div class="row post_author_infos justify-content-evenly">
                    <div class="col-12">
                        <span class="author_date">Publié le <?php echo e(\Carbon\Carbon::parse($post->post_created_at)->format('d/m/Y H:i')); ?> par</span>
                        <br>
                        <img src="<?php echo e(asset('storage/images/users/profile/' . $post->author_image)); ?>" alt="" class="author_img mt-3" style="width: 40px; height: 40px; object-fit: cover;">
                        <span class="author_name"><?php echo e($post->last_name); ?> <?php echo e($post->first_name); ?></span>
                    </div>
                </div>
                <div class="row mt-5">
                    <span class="category">
                        <b>Catégorie: </b> <?php echo e($post->section_name); ?>

                    </span>
                </div>
                <div class="row mt-3">
                    <?php if($post->code): ?>
                        <div class="col-5">
                            <?php else: ?>
                                <div class="col-7">
                                    <?php endif; ?>
                                    <h5 class="section_title">Message</h5>
                                    <div class="message_area p-5">
                                        <?php echo nl2br(e($post->message)); ?>

                                    </div>
                                </div>
                                <?php if($post->code): ?>
                                    <div class="col-7">
                                        <h5 class="section_title">Code</h5>
                                        <div class="message_area p-5">
                                <pre class="code_area">
                                    <code class="language-<?php echo e($post->language); ?>" id="code_insert">
                                        <?php echo str_replace(['{', '}'], '{', htmlspecialchars($post->code, ENT_QUOTES, 'UTF-8')); ?>

                                    </code>
                                </pre>
                                        </div>
                                    </div>
                                <?php endif; ?>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                        <span class="like_row">
                            <b id="likeCount"><?php echo e($likes); ?></b> j'aime
                            <?php if(!$isLiked): ?>
                                <i class="fa-solid fa-thumbs-up like_button"></i>
                            <?php else: ?>
                                <i class="fa-solid fa-thumbs-down like_button liked"></i>
                            <?php endif; ?>
                        </span>
                            </div>
                            <div class="col-6 text-end">
                                <div>
                                    <button class="comment_button"  id="showComment">Publier un commentaire</button>
                                </div>
                                <?php if(auth()->user()->id === $post->author): ?>
                                    <form id="deleteForm" action="<?php echo e(route('posts.delete', ['postId' => $post->post_id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="mt-3">
                                            <button type="button" class="delete_button" id="deletePostButton">Supprimer ce post</button>
                                        </div>
                                    </form>
                                <?php endif; ?>

                            </div>
                        </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <hr style="width: 80%;">
            </div>
            <div class="container-fluid">
                <div class="row m-2">
                    <h3 class="comment_title">Commentaires</h3>
                </div>
            </div>
            <div id="comment-overlay" class="col-6 p-5">
                <div class="comment-content comment-form">
                    <h2 class="form_comment_title text-center">Ajouter un commentaire</h2>
                    <form action="<?php echo e(route('comments.post')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="message" style="color: #00A3FF;">Message</label>
                            <textarea class="form-control comment_message_area" id="message" name="message" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="code" style="color: #00A3FF;">Code</label>
                            <textarea class="form-control comment_code_area" id="code" name="code" rows="5"></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                        <div class="row justify-content-center">
                            <div class="col-4 text-center">
                                <button type="submit" class="comment_button">Ajouter le commentaire</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row m-3">
                    <div class="col-12 comment_zone p-5">
                        <div class="row post_author_infos justify-content-evenly">
                            <div class="col-12">
                                <img src="<?php echo e(asset('storage/images/users/profile/' . $comment->user_image)); ?>" alt="" class="author_img mt-3" style="width: 40px; height: 40px; object-fit: cover;">
                                <span class="author_name"><?php echo e($comment->last_name); ?> <?php echo e($comment->first_name); ?></span>
                            </div>
                        </div>
                        <div class="row comment_content">
                            <?php if($comment->code): ?>
                                <div class="col-4 comment_message mt-4">
                                    <?php else: ?>
                                        <div class="col-10 comment_message mt-4">
                                            <?php endif; ?>
                                            <div class="message_area p-5">
                                                <?php echo nl2br(e($comment->message)); ?>

                                            </div>
                                        </div>
                                        <?php if($comment->code): ?>
                                            <div class="col-8 comment_code">
                                <pre class="comment_code_content">
                                    <code class="language-<?php echo e($post->language); ?>" id="code_insert">
                                        <?php echo htmlspecialchars($comment->code, ENT_QUOTES, 'UTF-8'); ?>

                                    </code>
                                </pre>
                                            </div>
                                        <?php endif; ?>
                                </div>
                                <div class="row mt-4">
                                    <span class="author_date">Publié le <?php echo e(\Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i')); ?> </span>
                                </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(session()->has('success_comment')): ?>
                        <div class="success_div" id="success_div">
                            <div class="success_message">
                                <div class="row justify-content-end">
                                    <i class="fa-solid fa-circle-xmark text-right" id="closeSuccess"></i>
                                </div>
                                <div class="row justify-content-center">
                                    <img src="<?php echo e(asset('images/gifs/success.svg')); ?>" alt="" class="success_image">
                                    <h4 class="success_title text-center mt-2">Commentaire ajouté avec succès</h4>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $__env->stopSection(); ?>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var deleteButton = $('#deletePostButton');
                        var deleteForm = $('#deleteForm');

                        deleteButton.click(function() {
                            if (deleteButton.text() === "Supprimer ce post") {
                                deleteButton.text("Confirmer?");
                            } else {
                                deleteForm.submit();
                            }
                        });

                        $('.like_button').click(function() {
                            var likeButton = $(this);
                            var likeCountElement = $('#likeCount');

                            $.ajax({
                                url: '<?php echo e(url("/post/like")); ?>',
                                method: 'POST',
                                data: {
                                    postId: <?php echo e($post->post_id); ?>,
                                    _token: '<?php echo e(csrf_token()); ?>'
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response.success) {
                                        var likeCount = parseInt(likeCountElement.text());

                                        if (likeButton.hasClass('liked')) {
                                            likeCount--;
                                            likeButton.removeClass('liked');
                                            likeButton.removeClass('fa-thumbs-down').addClass('fa-thumbs-up');
                                        } else {
                                            likeCount++;
                                            likeButton.addClass('liked');
                                            likeButton.removeClass('fa-thumbs-up').addClass('fa-thumbs-down');
                                        }
                                        likeCountElement.text(likeCount);
                                    }
                                }
                            });
                        });

                        $('#showComment').click(function() {
                            $('#comment-overlay').toggle();
                        });
                        $('#closeSuccess').click(function() {
                            $('#success_div').hide();
                        });
                    });
                </script>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/posts/show.blade.php ENDPATH**/ ?>