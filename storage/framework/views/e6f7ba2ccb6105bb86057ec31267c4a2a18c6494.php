<link rel="stylesheet" href="<?php echo e(asset('css/pages/profile.css')); ?>">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php $__env->startSection('content'); ?>
    <div>
        <div class="container-fluid">
            <div class="row profile_page_infos <?php if($user->role_id == 1): ?> background-image-role1 <?php elseif($user->role_id == 3): ?> background-image-role3 <?php endif; ?>">
                <div class="col-4 col-lg-2">
                    <div class="profile_picture-container">
                        <img src="<?php echo e(asset('storage/images/users/profile/' . Auth::user()->avatar)); ?>" alt="" class="profile_picture" id="profileImage">
                        <div class="profile_picture-overlay" id="profileOverlay">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                </div>
                <div class="col-10 col-lg-10 col-sm-auto">
                    <p class="text-right user_role"><?php echo e($user->role); ?></p>
                    <h1 class="profile_main_title mb-0"> <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></h1>
                    <span class="username text-light"><?php echo e($user->name); ?></span><br>
                    <br>
                    <span class="user_level"><b>Niveau <?php echo e($user->level); ?></b></span>
                    <div class="range mt-2" style="--p:<?php echo e($user->experience); ?>">
                        <div class="range__label">Progress</div>
                    </div>
                    <span class="user_experience p-3"><b><?php echo e($user->experience); ?>xp / 100xp</b></span>
                    <div class="text-right">
                        <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('images/success/' . $badge->image)); ?>" alt="<?php echo e($badge->badge); ?>" class="badge_img" title="<?php echo e($badge->badge); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row profile_update_row mt-5">
                <div class="col-12">
                    <h2 class="custom_profile_title">Modifier votre profil</h2>
                </div>
                <div class="col-12 p-4">
                    <form action="<?php echo e(route('user.update')); ?>" method="POST" enctype="multipart/form-data" id="profileForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="row update_form">
                            <div class="col-6 update_profile_area">
                                <div class="row justify-content-between mt-5">
                                    <div class="col-5 edit_profile_field text-center">
                                        <label for="username">Nom d'utilisateur</label>
                                        <input type="text" id="name" name="name" value="<?php echo e($user->name); ?>" required>
                                    </div>
                                    <div class="col-5 edit_profile_field text-center">
                                        <label for="email">Email</label><br>
                                        <input type="email" id="email" name="email" value="<?php echo e($user->email); ?>" required>
                                    </div>

                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-5 edit_profile_field text-center">
                                        <label for="last_name">Prénom</label><br>
                                        <input type="text" id="last_name" name="last_name" value="<?php echo e($user->last_name); ?>" required>
                                    </div>
                                    <div class="col-5 edit_profile_field text-center">
                                        <label for="first_name">Nom</label><br>
                                        <input type="text" id="first_name" name="first_name" value="<?php echo e($user->first_name); ?>" required>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-5 edit_profile_field text-center">
                                        <label for="password">Mot de passe</label><br>
                                        <input type="password" id="password" name="password">
                                    </div>
                                    <div class="col-5 edit_profile_field text-center">
                                        <label for="gender">Genre</label><br>
                                        <select id="gender" name="gender">
                                            <option value="/">Non spécifié</option>
                                            <option value="M" <?php echo e($user->gender === 'M' ? 'selected' : ''); ?>>Masculin</option>
                                            <option value="F" <?php echo e($user->gender === 'F' ? 'selected' : ''); ?>>Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-2 mb-4">
                                    <div class="col-4 text-center">
                                        <button type="submit" class="update_profile_button">Modifier</button>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="image" name="image" style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileOverlay = document.getElementById('profileOverlay');
        const imageInput = document.getElementById('image');
        const profileForm = document.getElementById('profileForm');

        profileOverlay.addEventListener('click', function() {
            imageInput.click();
        });

        imageInput.addEventListener('change', function() {
            profileForm.submit();
        });
    });
</script>

<?php echo $__env->make('layouts.app_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /mnt/c/xampp/htdocs/INTRA/resources/views/user/profile.blade.php ENDPATH**/ ?>