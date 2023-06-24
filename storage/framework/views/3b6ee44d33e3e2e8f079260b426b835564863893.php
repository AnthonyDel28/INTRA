<link rel="stylesheet" href="<?php echo e(asset('css/pages/admin.css')); ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/css/bootstrap.min.css">
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title">
                <i class="fa-solid fa-folder-gear"></i> Administration
            </h1>
        </div>
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#members">Membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#posts">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#comments">Commentaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#news">Actualités</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#reports">Rapports</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show" id="members">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des membres</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>ID</th>
                                    <th>Pseudo</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="user-row">
                                        <td><img src="<?php echo e(asset('storage/images/users/profile/' . $user->image)); ?>" alt="" class="post_img" style="object-fit: cover; width: 30px; height: 30px;"></td>
                                        <td><?php echo e($user->id); ?></td>
                                        <td class="username-cell"><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->last_name); ?> <?php echo e($user->first_name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->role_name); ?></td>
                                        <td><?php echo e($user->created_at); ?></td>
                                        <td>
                                            <button class="btn btn-warning update-user-btn" data-user-id="<?php echo e($user->id); ?>">Modifier</button>
                                            <button class="btn btn-danger hide-post-btn" data-post-id="<?php echo e($user->id); ?>">Désactiver</button>
                                        </td>
                                    </tr>
                                    <tr class="edit-form-row" style="display: none;">
                                        <td colspan="8">
                                            <form class="edit-form" method="POST">
                                                <?php echo method_field('PUT'); ?>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Pseudo</label>
                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo e($user->username); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="first_name" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo e($user->first_name); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="last_name" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo e($user->last_name); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Rôle</label>
                                                    <select class="form-select" id="role" name="role">
                                                        <option value="1" <?php echo e($user->role_id === '1' ? 'selected' : ''); ?>>Admin</option>
                                                        <option value="2" <?php echo e($user->role_id === '2' ? 'selected' : ''); ?>>Modérateur</option>
                                                        <option value="3" <?php echo e($user->role_id === '3' ? 'selected' : ''); ?>>Utilisateur</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary save-changes-btn">Enregistrer les modifications</button>
                                                <button type="button" class="btn btn-secondary cancel-changes-btn">Annuler</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="posts">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des posts</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Auteur</th>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="post-row">
                                        <td><?php echo e($post->id); ?></td>
                                        <td><?php echo e($post->user_name); ?></td>
                                        <td><?php echo e($post->title); ?></td>
                                        <td><?php echo e(substr($post->message, 0, 10)); ?></td>
                                        <td><?php echo e($post->created_at); ?></td>
                                        <td>
                                            <button class="btn btn-primary show-post-btn" id="show-post-btn">Voir tout</button>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".show-post-btn").click(function() {
                                                        var buttonText = $(this).text();
                                                        if (buttonText === "Voir tout") {
                                                            $(this).text("Réduire");
                                                        } else {
                                                            $(this).text("Voir tout");
                                                        }
                                                    });
                                                });

                                            </script>
                                            <button class="btn btn-danger delete-post-btn" data-post-id="<?php echo e($post->id); ?>">Supprimer</button>
                                            <button class="btn btn-secondary hide-post-btn" data-post-id="<?php echo e($post->id); ?>">Masquer</button>
                                        </td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="6">
                                            <div class="details-content">
                                                <u><b><h4>Titre:</h4></b></u>
                                                <p><?php echo e($post->title); ?></p>
                                                <u><b><h4>Contenu:</h4></b></u>
                                                <p><?php echo e($post->message); ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="comments">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des commentaires</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Post</th>
                                    <th>Commentaire</th>
                                    <th>Auteur</th>
                                    <th>Date de publication</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="comment-row">
                                        <td><?php echo e($comment->id); ?></td>
                                        <td><?php echo e(substr($comment->post_title, 0, 10)); ?></td>
                                        <td><?php echo e(substr($comment->message, 0, 10)); ?></td>
                                        <td><?php echo e($comment->author_name); ?></td>
                                        <td><?php echo e($comment->created_at); ?></td>
                                        <td>
                                            <button class="btn btn-primary show-comment-btn" id="show-comment-btn">Voir tout</button>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".show-comment-btn").click(function() {
                                                        var buttonText = $(this).text();
                                                        if (buttonText === "Voir tout") {
                                                            $(this).text("Réduire");
                                                        } else {
                                                            $(this).text("Voir tout");
                                                        }
                                                    });
                                                });

                                            </script>
                                            <button class="btn btn-danger delete-comment-btn" data-comment-id="<?php echo e($comment->id); ?>">Supprimer</button>
                                            <button class="btn btn-secondary hide-post-btn" data-comment-id="<?php echo e($comment->id); ?>">Masquer</button>
                                        </td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="6">
                                            <div class="details-content">
                                                <u><b><h4>Titre du post:</h4></b></u>
                                                <p><?php echo e($comment->post_title); ?></p>
                                                <u><b><h4>Commentaire:</h4></b></u>
                                                <p><?php echo e($comment->message); ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="news">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des actualités</h3>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="tab-pane" id="reports">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des rapports</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>Auteur</th>
                                    <th>Titre</th>
                                    <th>Rapport</th>
                                    <th>Date de publication</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="report-row">
                                        <td><?php echo e($report->username); ?></td>
                                        <td><?php echo e(substr($report->title, 0, 10)); ?></td>
                                        <td><?php echo e(substr($report->message, 0, 10)); ?></td>
                                        <td><?php echo e($report->created_at); ?></td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="4">
                                            <div class="details-content">
                                                <u><b><h4>Titre:</h4></b></u>
                                                <p><?php echo e($report->title); ?></p>
                                                <u><b><h4>Rapport</h4></b></u>
                                                <p><?php echo e($report->message); ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    $(document).ready(function() {
        $(".update-user-btn").click(function() {
            var userId = $(this).data("user-id");
            var editFormRow = $(this).closest("tr").next(".edit-form-row");

            $(".edit-form-row").not(editFormRow).hide();
            editFormRow.toggle();
        });
        $(".edit-form").submit(function(e) {
            e.preventDefault();
            var userId = $(this).closest(".edit-form-row").prev().find(".update-user-btn").data("user-id");
            var form = $(this);

            var username = form.find("#username").val();
            var firstName = form.find("#first_name").val();
            var lastName = form.find("#last_name").val();
            var email = form.find("#email").val();
            var role = form.find("#role").val();

            $.ajax({
                url: "/admin/update/user/" + userId,
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    username: username,
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    role: role
                },
                success: function(response) {
                    console.log("Mise à jour réussie");
                    $(".username-cell[data-user-id='" + userId + "']").text(username);
                    var url = window.location.href;
                    url = url.split('#')[0];
                    url += "#members";
                    window.location.href = url;
                    location.reload();
                    localStorage.setItem('success_user_update', 'Mise à jour réussie !');
                },
                error: function(xhr, status, error) {
                    console.log("Erreur lors de la mise à jour : " + error);
                }
            });
        });
    });
    $(document).ready(function() {
        var successMessage = localStorage.getItem('success_user_update');
        if (successMessage) {
            var alertDiv = $('<div>').addClass('alert alert-success').text(successMessage);
            $('.main_title').after(alertDiv);
            localStorage.removeItem('success_user_update');
        }
    });
</script>


<script>
    $(document).ready(function() {
        $(".toggle-edit-form-btn").click(function() {
            var userId = $(this).data("user-id");
            var editFormRow = $(this).closest("tr").next(".edit-form-row");

            $(".edit-form-row").not(editFormRow).hide();

            editFormRow.toggle();
        });

        $(".cancel-changes-btn").click(function() {
            var editFormRow = $(this).closest(".edit-form-row");
            editFormRow.hide();
        });

        $(".edit-form").submit(function(e) {
            e.preventDefault();

        });
    });

</script>

<script>
    $(document).ready(function() {
        $(".delete-post-btn").click(function() {
            var postId = $(this).data("post-id");
            var deleteButton = $(this);

            $.ajax({
                url: "/posts/delete/" + postId,
                type: "DELETE",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    deleteButton.closest(".post-row").next(".details-row").remove();
                    deleteButton.closest(".post-row").remove();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
        $(".delete-comment-btn").click(function() {
            var commentId = $(this).data("comment-id");
            var deleteButton = $(this);

            $.ajax({
                url: "/comment/delete/" + commentId,
                type: "DELETE",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    deleteButton.closest(".comment-row").next(".details-row").remove();
                    deleteButton.closest(".comment-row").remove();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });


    });
</script>



<script>
    $(document).ready(function() {
        $(".details-row").hide();
        $(".report-row").click(function() {
            $(".details-row").not($(this).next()).slideUp();
            $(this).next().slideToggle();
        });
    });

    $(document).ready(function() {
        $(".details-row").hide();
        $(".show-comment-btn").click(function() {
            $(this).closest(".comment-row").next(".details-row").slideToggle();
        });
    });

    $(document).ready(function() {
        $(".details-row").hide();
        $(".show-post-btn").click(function() {
            $(this).closest(".post-row").next(".details-row").slideToggle();
        });
    });
</script>

<script>
    $(".hide-post-btn").click(function() {
        var postId = $(this).data("post-id");

        $.ajax({
            url: "/posts/" + postId + "/hide",
            type: "PUT",
            success: function(response) {
                $(this).closest(".post-row").next(".details-row").toggle();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>



<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/admin/admin.blade.php ENDPATH**/ ?>