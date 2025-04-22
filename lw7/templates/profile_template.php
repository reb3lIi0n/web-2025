<?php
    $profileData = include('php/profile_data.php');
    $user = $profileData['user'];
    $profile = $profileData['profile'];
?>

<div class="profile">
    <div class="profile__header">
        <div class="profile__info">
            <img src="<?= $profile['profile_image'] ?>" class="profile__image" alt="user image">
            <h1 class="profile__title"><?= $profile['title'] ?></h1>
            <p class="profile__description"><?= $profile['profile_description'] ?></p>
            <div class="profile__post-count">
                <img src="icons/images_count.png" height="16" width="16" alt="images count">
                <span><?= $profile['post_count'] ?> поста</span>
            </div>  
        </div>
    </div>

    <div class="profile__gallery">
        <?php foreach ($profile['images'] as $image): ?>
            <img src="<?= $image ?>" class="profile__gallery-image" alt="image">
        <?php endforeach; ?>
    </div>
</div>
