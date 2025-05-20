document.addEventListener('DOMContentLoaded', function() {
    const posts = document.querySelectorAll('.post');

    posts.forEach(post => {
        const text = post.querySelector('.post-text');
        if (text) {
            const content = text.querySelector('.post-text-content');
            const ellipsis = text.querySelector('.post-text-ellipsis');
            const toggle = text.querySelector('.post-text-toggle');

            if (content && ellipsis && toggle) {
                // Принудительно устанавливаем высоту для проверки
                text.style.maxHeight = '3em';
                text.style.lineHeight = '1.5em';

                // Проверяем, превышает ли текст высоту контейнера
                if (content.scrollHeight > text.clientHeight + 1) { // +1 для точности
                    ellipsis.style.display = 'inline';
                    toggle.style.display = 'inline';
                }

                // Обработчик клика
                toggle.addEventListener('click', function() {
                    if (text.classList.contains('expanded')) {
                        text.classList.remove('expanded');
                        toggle.textContent = 'ещё';
                    } else {
                        text.classList.add('expanded');
                        toggle.textContent = 'свернуть';
                    }
                });
            }
        }
    });
});