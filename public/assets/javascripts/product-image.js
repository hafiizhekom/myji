const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('mouseover', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    // const displayWidth = document.querySelector('.img-showcase .container-img:first-child img').clientWidth;
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
    // const showcaseImgs = document.querySelectorAll('.container-img img');
    // const showcaseImages = [... showcaseImgs];
    // showcaseImages.forEach((imgShowcase) => {
    //     imgShowcase.style.width = `${displayWidth}px`
    //     console.log(imgShowcase.style.width = displayWidth)
    // })
}

window.addEventListener('resize', slideImage)