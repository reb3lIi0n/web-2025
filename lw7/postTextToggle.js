document.addEventListener('DOMContentLoaded', () => {
    const posts = document.querySelectorAll('.post');

    posts.forEach(post => {
        const postText = post.querySelector('.post-text');
        const toggleButton = post.querySelector('.post-text-toggle');

        if (!postText || !postText.textContent.trim()) {
            if (toggleButton) toggleButton.style.display = 'none';
            return;
        }

        const initialMaxHeight = postText.style.maxHeight;
        const initialWebkitLineClamp = postText.style.webkitLineClamp;

        postText.style.maxHeight = 'none';
        postText.style.webkitLineClamp = 'unset';
        postText.style.overflow = 'visible';
        postText.style.textOverflow = 'unset';

        const fullHeight = postText.scrollHeight;
        const lineHeight = parseFloat(window.getComputedStyle(postText).lineHeight);
        const twoLineHeight = lineHeight * 2;

        postText.style.maxHeight = initialMaxHeight;
        postText.style.webkitLineClamp = initialWebkitLineClamp;
        postText.style.overflow = 'hidden';
        postText.style.textOverflow = 'ellipsis';

        if (fullHeight > twoLineHeight + 5) {
            toggleButton.style.display = 'inline-block';
            postText.classList.remove('expanded');
            toggleButton.textContent = 'ещё';
        } else {
            toggleButton.style.display = 'none';
            postText.classList.remove('expanded');
        }

        toggleButton.addEventListener('click', (event) => {
            event.preventDefault();
            postText.classList.toggle('expanded');

            if (postText.classList.contains('expanded')) {
                toggleButton.textContent = 'свернуть';
            } else {
                toggleButton.textContent = 'ещё';
            }
        });
    });
});