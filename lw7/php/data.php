<?php
include('validation.php');

// Подключение к базе данных
require_once 'config/db.php';  // подключаем конфиг с PDO

// Получаем данные о пользователях из базы данных
$sqlUsers = "SELECT id, name FROM user";  // столбец 'users_img'
$stmt = $pdo->query($sqlUsers);
$users = $stmt->fetchAll();

// Получаем данные о постах из базы данных
$sqlPosts = "
    SELECT p.id, p.images, p.image_count, p.edit, p.title, p.likes_count, p.created_at, p.user_id, p.users_img 
    FROM post p
    JOIN user u ON p.user_id = u.id
    ORDER BY p.created_at DESC
";
$stmt = $pdo->query($sqlPosts);
$posts = $stmt->fetchAll();

// Создаем ассоциативный массив с пользователями
$userMap = [];
foreach ($users as $user) {
    // Валидация для каждого пользователя
    if (!validateStringLength($user['name'], 3, 50)) {
        echo "Ошибка: Имя пользователя '{$user['name']}' слишком короткое или длинное.\n";
        continue;
    }
    if (!validateType($user['id'], 'int')) {
        echo "Ошибка: ID пользователя '{$user['id']}' должен быть целым числом.\n";
        continue;
    }
    // Создаем отображение пользователя по ID
    $userMap[$user['id']] = $user['name'];
}

// Валидация данных постов
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

// Функция для времени
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

// Функция для правильной формы слов
function pluralForm($number, $form1, $form2, $form5) {
    $n = abs($number) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    if ($n1 > 1 && $n1 < 5) return $form2;
    if ($n1 == 1) return $form1;
    return $form5;
}
?>
