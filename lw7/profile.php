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
        <div class="sidebar">
            <a href="home.php"><img src="icons/home.png" height="24" width="24" alt="home"></a>
            <a href="profile.php?id=1"><img src="icons/profile.png" height="24" width="24" alt="profile"></a>
            <a href="create_post.html"><img src="icons/new_post.png" height="24" width="24" alt="new post"></a>
        </div>
        <?php include 'templates/profile_template.php'; ?>
    </body>
</html>
