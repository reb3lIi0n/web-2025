<?php
include('validation.php');
$postData = file_get_contents('post.json');
$userData = file_get_contents('users.json');
$posts = json_decode($postData, true);
$users = json_decode($userData, true);
$userMap = [];
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
foreach ($posts as $post) {
    if (!validateType($post['likes_count'], 'int')) {
        echo "Ошибка: Количество лайков должно быть целым числом.\n";
        continue;
    }
    if (!validateTimestamp($post['created_at'])) {
        echo "Ошибка: Неверная дата поста: {$post['created_at']}.\n";
        continue;
    }
}
foreach ($users as $user) {
    $userMap[$user['id']] = $user['name'];
}
function timeAgo($timestamp) {
    $timeDiff = time() - $timestamp;
    if ($timeDiff < 60) {
        return "меньше минуты назад";
    } elseif ($timeDiff < 3600) {
        $minutes = floor($timeDiff / 60);
        return "$minutes " . pluralForm($minutes, "минуту", "минуты", "минут") . " назад";
    } elseif ($timeDiff < 86400) {
        $hours = floor($timeDiff / 3600);
        return "$hours " . pluralForm($hours, "час", "часа", "часов") . " назад";
    } else {
        $days = floor($timeDiff / 86400);
        return "$days " . pluralForm($days, "день", "дня", "дней") . " назад";
    }
}
function pluralForm($number, $form1, $form2, $form5) {
    $n = abs($number) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}
?>