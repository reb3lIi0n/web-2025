CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

-- Создание таблицы постов (post)
CREATE TABLE post (
    id INT PRIMARY KEY AUTO_INCREMENT,
    images VARCHAR(255) NOT NULL,
    image_count VARCHAR(255),
    edit VARCHAR(255),
    title TEXT,
    user_id INT,
    users_img VARCHAR(255),
    likes_count INT,
    created_at INT,
    FOREIGN KEY (user_id) REFERENCES user(id)
);