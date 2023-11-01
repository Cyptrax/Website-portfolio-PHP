window.addEventListener('scroll', () => {
    const scrollPosition = window.scrollY;
    const image = document.getElementById('moving-image');
    const maxRight = window.innerWidth - image.clientWidth;

    // Calculate the new right position for the image based on the scroll position
    const newRight = (scrollPosition / (document.body.scrollHeight - window.innerHeight)) * maxRight;

    // Apply the new right position to the image
    image.style.right = newRight + 'px';
});

/* Dit is niet zelf geschreven*/