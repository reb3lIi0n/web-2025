<div class="post">
    <div class="post-header">
        <div class="post-header__left">
            <img src="<?= $post['profile_image'] ?>" class="user-image" height="32" width="32" alt="User Image">
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
        <?php if (is_array($post['images']) && count($post['images']) > 1): ?>
            <?php $images = (!empty($post['images'])) ? $post['images'] : [];?>
            <div class="post-slider" data-images='<?= json_encode($images) ?>'>
                <div class="slider-container">
                    <?php foreach ($post['images'] as $image): ?>
                        <img src="<?= $image ?>" class="slider-image" height="474" width="474" style="display: none;" alt="Изображение поста">
                    <?php endforeach; ?>
                </div>
                <button class="slider-button prev">❮</button>
                <button class="slider-button next">❯</button>
                <span class="slider-indicator">1/<?= count($post['images']) ?></span>
            </div>
        <?php else: ?>
            <div class="single-post-image-container" data-images='<?= json_encode(is_array($post['images']) ? $post['images'] : [$post['images']]) ?>'>
                <img src="<?= is_array($post['images']) ? $post['images'][0] : $post['images'] ?>" class="single-post-image" alt="Изображение поста">
            </div>
        <?php endif; ?>
    </div>

    <p class="likes-count">
        <img src="icons/like.png" height="16" width="18" alt="like"> <?= $post['likes_count'] ?>
    </p>
    <div class="post">
        <p class="post-text">
            <span class="post-text-content"><?= $post['title'] ?></span>
            <span class="post-text-ellipsis">...</span>
            <button class="post-text-toggle">ещё</button>
        </p>
    </div>

    <p class="post-time"><?= timeAgo($post['created_at']) ?></p>
</div>