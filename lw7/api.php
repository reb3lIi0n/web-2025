<?php
$host = 'localhost';
$db   = 'blog';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['title']) || !isset($data['image'])) {
        echo json_encode(['error' => 'Missing required fields: title, images, or user_id.']);
        exit;
    }
    $title = $data['title'];
    $images = $data['images'];
    $image_count = isset($data['image_count']) ? $data['image_count'] : null;
    $edit = isset($data['edit']) ? $data['edit'] : null;
    $user_id = $data['user_id'];
    $users_img = isset($data['users_img']) ? $data['users_img'] : null;
    $likes_count = isset($data['likes_count']) ? $data['likes_count'] : 0;
    $created_at = time();
    if (isset($_FILES['image'])) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'images/' . $imageName;

        if (move_uploaded_file($imageTmp, $imagePath)) {
            $images = $imagePath;
        } else {
            echo json_encode(['error' => 'Failed to upload image.']);
            exit;
        }
    }

    $query = "INSERT INTO post (title, images, image_count, edit, user_id, users_img, likes_count, created_at)
              VALUES (:title, :images, :image_count, :edit, :user_id, :users_img, :likes_count, :created_at)";
    
    $stmt = $pdo->prepare($query);
    try {
        $stmt->execute([
            ':title' => $title,
            ':images' => $images,
            ':image_count' => $image_count,
            ':edit' => $edit,
            ':user_id' => $user_id,
            ':users_img' => $users_img,
            ':likes_count' => $likes_count,
            ':created_at' => $created_at,
        ]);
        echo json_encode(['message' => 'Post successfully created!']);
    } catch (\PDOException $e) {
        echo json_encode(['error' => 'Failed to insert post: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
