<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Лента</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
    <link href="styles/home_style.css" rel="stylesheet">
</head>

<body>
    <?php include 'php/data.php'; ?>
    <div class="page">
        <div class="sidebar">
            <a href="home.php"><img src="icons/home.png" height="24" width="24" alt="home"></a>
            <a href="profile.php?id=1"><img src="icons/profile.png" height="24" width="24" alt="profile"></a>
            <a href="create_post.html"><img src="icons/new_post.png" height="24" width="24" alt="new post"></a>
        </div>
        <main class="main-text">
            <?php foreach ($posts as $post): ?>
                <?php include 'templates/post_template.php'; ?>
            <?php endforeach; ?>
        </main>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">×</span>
            <div class="modal-slider">
                <div class="modal-slider-container">

                </div>
                <button class="modal-slider-button prev">❮</button>
                <button class="modal-slider-button next">❯</button>
                <span class="modal-slider-indicator">1/1</span>
            </div>
        </div>
    </div>
    <script src="slider.js"></script>
    <script type="module" src="postTextToggle.js"></script>
</body>

</html>