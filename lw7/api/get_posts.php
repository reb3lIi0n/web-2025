<?php
header('Content-Type: application/json');
require_once '../config/db.php';

$sql = "
    SELECT 
        post.id,
        post.images,
        post.image_count,
        post.edit,
        post.title,
        post.user_id,
        post.users_img,
        post.likes_count,
        post.created_at,
        user.name
    FROM post
    JOIN user ON post.user_id = user.id
    ORDER BY post.created_at DESC
";

try {
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll();

    echo json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch posts: ' . $e->getMessage()]);
}
?>