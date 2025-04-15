INSERT INTO user (id, name) VALUES
(1, 'Ваня Денисов'),
(2, 'Лиза Дёмина');

INSERT INTO post (id, images, image_count, edit, title, user_id, users_img, likes_count, created_at) VALUES
(1, 'images/image0.png', '1/3', 'icons/edit.png', 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...', 1, 'users_img/vanya.png', 203, 1743525660),
(2, 'images/image1.png', NULL, NULL, NULL, 2, 'users_img/liza.png', 534, 1743352860);