<?php
header('Content-Type: application/json');

require_once 'config/db.php';
require_once 'validation.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Разрешены только POST запросы.']);
    exit;
}

$uploadDir = __DIR__ . '/images/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$postDataJsonString = $_POST['post_data_json'] ?? null;
$requestBody = file_get_contents('php://input');
$data = null;

if ($postDataJsonString !== null) {
    $data = json_decode($postDataJsonString, true);
} elseif (!empty($requestBody)) {
    $data = json_decode($requestBody, true);
}

$imageFile = $_FILES['image'] ?? null;

if ($data === null || !is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Некорректные или отсутствуют JSON данные поста.']);
    exit;
}
$userId = $data['user_id'] ?? null;
$title = $data['title'] ?? null;
$imageCount = $data['image_count'] ?? null;
$edit = $data['edit'] ?? null;
$likesCount = $data['likes_count'] ?? 0;
if ($userId === null || $title === null) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Отсутствуют обязательные поля: user_id или title.']);
    exit;
}
if (!validateType($userId, 'int') || $userId <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Некорректный или отсутствующий user_id.']);
    exit;
}
try {
    $stmt = $pdo->prepare("SELECT id FROM user WHERE id = :id");
    $stmt->execute([':id' => $userId]);
    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Пользователь с указанным user_id не найден.']);
        exit;
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Ошибка базы данных: ' . $e->getMessage()]);
    exit;
}
if (!validateStringLength($title, 3, 255)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Title должен быть длиной от 3 до 255 символов.']);
    exit;
}

if (empty($imageFile) || $imageFile['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Ошибка загрузки изображения или изображение отсутствует.']);
    exit;
}

$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($imageFile['tmp_name']);

if (!in_array($mimeType, $allowedTypes)) {
    @unlink($imageFile['tmp_name']);
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Недопустимый тип файла изображения. Разрешены: JPEG, PNG, GIF.']);
    exit;
}

$maxFileSize = 5 * 1024 * 1024;
if ($imageFile['size'] > $maxFileSize) {
    @unlink($imageFile['tmp_name']);
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Размер файла изображения превышает допустимый лимит (5MB).']);
    exit;
}

$imageFileName = uniqid('post_') . '_' . basename($imageFile['name']);
$uploadFilePath = $uploadDir . $imageFileName;

if (!move_uploaded_file($imageFile['tmp_name'], $uploadFilePath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Не удалось сохранить загруженное изображение.']);
    exit;
}

$imagePathForDb = './images/' . $imageFileName;

try {
    $stmt = $pdo->prepare("
        INSERT INTO post (user_id, images, title, image_count, edit, likes_count, created_at)
        VALUES (:user_id, :images, :title, :image_count, :edit, :likes_count, :created_at)
    ");
    $stmt->execute([
        ':user_id' => $userId,
        ':images' => $imagePathForDb,
        ':title' => $title,
        ':image_count' => $imageCount,
        ':edit' => $edit,
        ':likes_count' => $likesCount,
        ':created_at' => time()
    ]);

    $newPostId = $pdo->lastInsertId();
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Пост успешно создан.',
        'postId' => $newPostId,
        'imagePath' => $imagePathForDb
    ]);
} catch (PDOException $e) {
    @unlink($uploadFilePath);
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении поста в базу данных: ' . $e->getMessage()]);
}
?>