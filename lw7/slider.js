document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.post-slider');

    sliders.forEach(slider => {
        const images = slider.querySelectorAll('.slider-image');
        const prevButton = slider.querySelector('.slider-button.prev');
        const nextButton = slider.querySelector('.slider-button.next');
        const indicator = slider.querySelector('.slider-indicator');

        let currentIndex = 0;
        const totalImages = images.length;

        function showImage(index) {
            images.forEach((img, i) => {
                img.style.display = i === index ? 'block' : 'none';
            });
            indicator.textContent = `${index + 1}/${totalImages}`;
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % totalImages;
            showImage(currentIndex);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            showImage(currentIndex);
        }

        // Показываем первое изображение при загрузке
        showImage(currentIndex);

        // Назначаем обработчики событий для кнопок
        nextButton.addEventListener('click', nextImage);
        prevButton.addEventListener('click', prevImage);
    });
});