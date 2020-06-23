function smoothScrool(x) {
    var element = x;

    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}