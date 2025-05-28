document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.post-slider');
    const singlePostImages = document.querySelectorAll('.single-post-image-container');

    function showImage(images, index, indicator) {
        images.forEach((img, i) => {
            img.style.display = i === index ? 'block' : 'none';
        });
        indicator.textContent = `${index + 1}/${images.length}`;
    }

    sliders.forEach(slider => {
        const images = slider.querySelectorAll('.slider-image');
        const prevButton = slider.querySelector('.slider-button.prev');
        const nextButton = slider.querySelector('.slider-button.next');
        const indicator = slider.querySelector('.slider-indicator');

        let currentIndex = 0;

        function nextImage(e) {
            e.stopPropagation();
            currentIndex = (currentIndex + 1) % images.length;
            showImage(images, currentIndex, indicator);
        }

        function prevImage(e) {
            e.stopPropagation();
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(images, currentIndex, indicator);
        }

        showImage(images, currentIndex, indicator);

        nextButton.addEventListener('click', nextImage);
        prevButton.addEventListener('click', prevImage);

        slider.querySelector('.slider-container').addEventListener('click', () => {
            openModal(slider.getAttribute('data-images'), currentIndex);
        });
    });

    singlePostImages.forEach(container => {
        container.addEventListener('click', () => {
            openModal(container.getAttribute('data-images'), 0);
        });
    });

    function openModal(imagesData, startIndex) {
    const modal = document.getElementById('modal');
    const modalContainer = modal.querySelector('.modal-slider-container');
    const modalPrevButton = modal.querySelector('.modal-slider-button.prev');
    const modalNextButton = modal.querySelector('.modal-slider-button.next');
    const modalIndicator = modal.querySelector('.modal-slider-indicator');

    if (!modal || !modalContainer || !modalPrevButton || !modalNextButton || !modalIndicator) {
        return;
    }

    let imagesArray;
    try {
        imagesArray = JSON.parse(imagesData);
    } catch (e) {
        return;
    }

    if (!Array.isArray(imagesArray) || imagesArray.length === 0) {
        modalContainer.innerHTML = '<p>Изображений нет</p>';
        modal.style.display = 'flex';
        return;
    }

    modalContainer.innerHTML = '';
    imagesArray.forEach((src, index) => {
        const img = document.createElement('img');
        img.src = src;
        img.className = 'modal-slider-image';
        img.alt = 'Изображение в модальном окне ' + index;
        img.style.display = 'none';
        modalContainer.appendChild(img);
    });

    const modalImagesList = modalContainer.querySelectorAll('.modal-slider-image');
    let modalIndex = Math.min(Math.max(startIndex, 0), imagesArray.length - 1);

    if (imagesArray.length === 1) {
        modalPrevButton.style.display = 'none';
        modalNextButton.style.display = 'none';
        modalIndicator.style.display = 'none';
    } else {
        modalPrevButton.style.display = 'flex';
        modalNextButton.style.display = 'flex';
        modalIndicator.style.display = 'block';
    }

    showImage(modalImagesList, modalIndex, modalIndicator);

    function modalNextImage() {
        modalIndex = (modalIndex + 1) % imagesArray.length;
        showImage(modalImagesList, modalIndex, modalIndicator);
    }

    function modalPrevImage() {
        modalIndex = (modalIndex - 1 + imagesArray.length) % imagesArray.length;
        showImage(modalImagesList, modalIndex, modalIndicator);
    }

    if (imagesArray.length > 1) {
        modalNextButton.removeEventListener('click', modalNextImage);
        modalPrevButton.removeEventListener('click', modalPrevImage);
        modalNextButton.addEventListener('click', modalNextImage);
        modalPrevButton.addEventListener('click', modalPrevImage);
    }

    modal.style.display = 'flex';

    const closeModalHandler = () => {
        modal.style.display = 'none';
    };

    const closeModal = document.querySelector('.close-modal');
    if (closeModal) {
        closeModal.removeEventListener('click', closeModalHandler);
        closeModal.addEventListener('click', closeModalHandler);
    }

    const handleEsc = (event) => {
        if (event.keyCode === 27) {
            closeModalHandler();
            document.removeEventListener('keydown', handleEsc);
        }
    };

    document.addEventListener('keydown', handleEsc);
}

document.querySelectorAll('.post-slider').forEach(slider => {
    slider.addEventListener('click', () => {
        const imagesData = slider.getAttribute('data-images');
        openModal(imagesData, 0);
    });
});
});