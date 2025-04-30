<div class="post">
    <div class="post-header">
        <div class="post-header__left">
        <img src="<?= $post['profile_image']?>" class="user-image" height="32" width="32" alt="User Image">
            <a class="profile-name" href="profile.php?id=<?= $post['user_id'] ?>">
                <?= $userMap[$post['user_id']] ?? 'Неизвестный пользователь' ?>
            </a>
        </div>

        <?php if (!empty($post['edit'])): ?>
            <div class="edit">
                <a href="#"><img src="<?= $post['edit'] ?>" height="24" width="24" alt="edit"></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="post-image">
        <?php if (!empty($post['image_count'])): ?>
            <div class="images-count">
                <span><?= $post['image_count'] ?></span>
            </div>
        <?php endif; ?>
        <img src="<?= $post['images'] ?>" height="474" width="474" alt="post image">
    </div>

    <p class="likes-count">
        <img src="icons/like.png" height="16" width="18" alt="like"> <?= $post['likes_count'] ?>
        </p>
    <?php if (!empty($post['title'])): ?>
        <p class="post-text"><?= $post['title'] ?></p>
        <a class="text-more" href="#">ещё</a>
    <?php endif; ?>

    <p class="post-time"><?= timeAgo($post['created_at']) ?></p>
</div>
