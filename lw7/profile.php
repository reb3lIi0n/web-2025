<?php
$profileData = include('php/profile_data.php');
$user = $profileData['user'];
$profile = $profileData['profile'];
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
        <link href="styles/profile_style.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <a href="home.php"><img src="icons/home.png" height="24" width="24" alt="home"></a>
            <a href="profile.php?id=<?= $user['id'] ?>"><img src="icons/profile.png" height="24" width="24" alt="profile"></a>
            <a href="#"><img src="icons/new_post.png" height="24" width="24" alt="new post"></a>
        </div>
        <div class="profile-unit">
            <div>
                <img src="<?= $profile['profile_image'] ?>" class="profile-image" alt="user image">
                <h1 class="title"><?= $profile['title'] ?></h1>
                <p class="profile-description"><?= $profile['profile_description'] ?></p>
                <div class="post-count">
                    <img src="icons/images_count.png" height="16" width="16" alt="images count">
                    <span><?= $profile['post_count'] ?> поста</span>
                </div>   
            </div>
            <div>
                <?php foreach ($profile['images'] as $image): ?>
                    <img src="<?= $image ?>" height="322" width="322" alt="image">
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
