<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
        <link href="styles/home_style.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'php/data.php'; ?>
        <div class="main-text">
            <div>
                <a href="home.php"><img src="icons/home.png" height="24" width="24" alt="home"></a>
                <a href="profile.php?id=1"><img src="icons/profile.png" height="24" width="24" alt="profile"></a>
                <a href="#"><img src="icons/new_post.png" height="24" width="24" alt="new post"></a>
            </div>
            <?php foreach ($posts as $post): ?>
            <div>
                <div>
                    <img src="<?= $post['users_img'] ?>" class="user-image" height="32" width="32" alt="User Image">
                    <a class="profile-name" href="profile.php?id=<?= $post['user_id'] ?>"><?= $userMap[$post['user_id']] ?? 'Неизвестный пользователь' ?></a>
                </div>
                <div>
                    <?php if (!empty($post['edit'])): ?>
                        <div class="edit">
                            <a href="#"><img src="<?= $post['edit'] ?>" height="24" width="24" alt="edit"></a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($post['image_count'])): ?>
                        <div class="images-count">
                            <span><?= $post['image_count'] ?></span>
                        </div>
                    <?php endif; ?>
                    <img src="<?= $post['images'] ?>" height="474" width="474" alt="post image">
                    <p class="likes-count">
                        <img src="icons/like.png" height="16" width="18" alt="like"> <?= $post['likes_count'] ?>
                    </p>
                    <?php if (!empty($post['title'])): ?>
                        <p><?= $post['title'] ?></p>
                        <a class="text-more" href="#">ещё</a>
                    <?php endif; ?>
                    <p class="post-time"><?= timeAgo($post['created_at']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
