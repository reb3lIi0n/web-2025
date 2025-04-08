<?php
include('validation.php');
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if ($id === null) {
    header('Location: home.php');
    exit;
}
$userData = file_get_contents('users.json');
$profileData = file_get_contents('profile.json');
$users = json_decode($userData, true);
$profiles = json_decode($profileData, true);
$user = null;
foreach ($users as $user) {
    if (!validateStringLength($user['name'], 3, 50)) {
        echo "Ошибка: Имя пользователя '{$user['name']}' слишком короткое или длинное.\n";
        continue;
    }
    if (!validateType($user['id'], 'int')) {
        echo "Ошибка: ID пользователя '{$user['id']}' должен быть целым числом.\n";
        continue;
    }
}
foreach ($profiles as $profile) {
    if (!validateType($profile['post_count'], 'int')) {
        echo "Ошибка: Количество постов должно быть целым числом.\n";
        continue;
    }
}
foreach ($users as $u) {
    if ($u['id'] === $id) {
        $user = $u;
        break;
    }
}
if ($user === null) {
    header('Location: home.php');
    exit;
}
$profile = null;
foreach ($profiles as $p) {
    if ($p['title'] === $user['name']) {
        $profile = $p;
        break;
    }
}
if ($profile === null) {
    header('Location: home.php');
    exit;
}
return compact('user', 'profile');
?>