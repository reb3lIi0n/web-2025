INSERT INTO user (id, name, profile_image) VALUES
(1, 'Ваня Денисов', 'users_img/vanya.png'),
(2, 'Лиза Дёмина', 'users_img/liza.png');

INSERT INTO post (id, images, image_count, edit, title, user_id, likes_count, created_at) VALUES
(1, '["./images/image0.png", "./images/image1.png", "./images/image2.png"]', '1/3', 'icons/edit.png', 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...', 1, 203, 1743525660),
(2, '["./images/image3.png"]', NULL, NULL, NULL, 2, 534, 1743352860);