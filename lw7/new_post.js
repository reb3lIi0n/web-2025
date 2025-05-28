const fileInput = document.getElementById('fileInput');
const addPhotoBlack = document.getElementById('addPhotoBlack');
const addPhotoBlue = document.getElementById('addPhotoBlue');
const slider = document.getElementById('slider');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
const indicator = document.getElementById('indicator');
const caption = document.getElementById('caption');
const shareButton = document.getElementById('share');

let images = [];
let currentIndex = 0;

function updateSlider() {
    slider.innerHTML = '';
    images.forEach((image, index) => {
        const img = document.createElement('img');
        img.src = image;
        img.className = 'new-post__slider-image';
        if (index === currentIndex) {
            img.classList.add('active');
        }
        slider.appendChild(img);
    });

    if (images.length > 0) {
        addPhotoBlack.classList.add('hidden');
        prevButton.classList.toggle('hidden', images.length <= 1);
        nextButton.classList.toggle('hidden', images.length <= 1);
        indicator.classList.toggle('hidden', images.length <= 1);
        indicator.textContent = `${currentIndex + 1}/${images.length}`;
    } else {
        addPhotoBlack.classList.remove('hidden');
        prevButton.classList.add('hidden');
        nextButton.classList.add('hidden');
        indicator.classList.add('hidden');
    }
    updateShareButton();
}

function addImages(files) {
    for (const file of files) {
        const reader = new FileReader();
        reader.onload = (e) => {
            images.push(e.target.result);
            updateSlider();
        };
        reader.readAsDataURL(file);
    }
}

addPhotoBlack.addEventListener('click', () => fileInput.click());
addPhotoBlue.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', (e) => {
    addImages(e.target.files);
    e.target.value = '';
});

prevButton.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        updateSlider();
    }
    else {
        currentIndex = images.length - 1;
        updateSlider();
    }
});

nextButton.addEventListener('click', () => {
    if (currentIndex < images.length - 1) {
        currentIndex++;
        updateSlider();
    }
    else {
        currentIndex = 0;
        updateSlider();
    }
});

function updateShareButton() {
    const hasImages = images.length > 0;
    const hasCaption = caption.value.trim().length > 0;
    if (hasImages && hasCaption) {
        shareButton.classList.add('active');
        shareButton.disabled = false;
    } else {
        shareButton.classList.remove('active');
        shareButton.disabled = true;
    }
}

caption.addEventListener('input', updateShareButton);

shareButton.addEventListener('click', () => {
    if (!shareButton.disabled) {
        const postData = {
            images: images,
            caption: caption.value.trim(),
            created_at: new Date().toISOString()
        };
        console.log('Новый пост:', postData);
    }
});