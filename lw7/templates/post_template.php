<div>
    <div>
        <img src="<?= $post['profile_image'] ?? './images/default_user.png' ?>" class="user-image" height="32" width="32" alt="Изображение пользователя">
        <a class="profile-name" href="profile.php?id=<?= $post['user_id'] ?>">
            <?= $userMap[$post['user_id']] ?? 'Неизвестный пользователь' ?>
        </a>
    </div>
    <div>
        <?php if (!empty($post['edit'])): ?>
            <div class="edit">
                <a href="#"><img src="<?= $post['edit'] ?>" height="24" width="24" alt="Редактировать"></a>
            </div>
        <?php endif; ?>
        <?php if (is_array($post['images']) && count($post['images']) > 1): ?>
            <div class="post-slider">
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
            <img src="<?= is_array($post['images']) ? $post['images'][0] : $post['images'] ?>" height="474" width="474" alt="Изображение поста">
        <?php endif; ?>
        <p class="likes-count">
            <img src="icons/like.png" height="16" width="18" alt="Лайк"> <?= $post['likes_count'] ?>
        </p>
        <?php if (!empty($post['title'])): ?>
            <p><?= $post['title'] ?></p>
            <a class="text-more" href="#">ещё</a>
        <?php endif; ?>
        <p class="post-time"><?= timeAgo($post['created_at']) ?></p>
    </div>
</div>