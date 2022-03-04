/* set default index */
let slideIndex = 1;
showSlides(slideIndex);

/* show next slide*/
function nextSlide() {
    showSlides(slideIndex += 1);
}

/* show prev slide*/
function previousSlide() {
    showSlides(slideIndex -= 1);  
}

/* set current slide */
function currentSlide(n) {
    showSlides(slideIndex = n);
}

/* function set slide */
function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("item");
    
    if (n > slides.length) {
      slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
  
  /* Проходим по каждому слайду в цикле for */
    for (let slide of slides) {
        slide.style.display = "none";
    }   
    slides[slideIndex - 1].style.display = "block"; 
}