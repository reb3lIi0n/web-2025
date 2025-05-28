<?php
include('validation.php');
require_once 'config/db.php';
$sqlUsers = "SELECT id, name FROM user";
$stmt = $pdo->query($sqlUsers);
$users = $stmt->fetchAll();

$sqlPosts = "
    SELECT p.id, p.images, p.image_count, p.edit, p.title, p.likes_count, p.created_at, p.user_id, u.profile_image 
    FROM post p
    JOIN user u ON p.user_id = u.id
";
$stmt = $pdo->query($sqlPosts);
$posts = $stmt->fetchAll();

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
    $userMap[$user['id']] = $user['name'];
}

foreach ($posts as &$post) {
    if (is_string($post['images'])) {
        $post['images'] = json_decode($post['images'], true);
        if (!is_array($post['images'])) {
            $post['images'] = [$post['images']];
        }
    }
}
unset($post);

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
function displayPostContent($post) {
    $content = $post['title'] ?? '';
    return htmlspecialchars($content);
}
?>
