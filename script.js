
const images = document.querySelectorAll('.image-slider img');
let currentImage = 0;

function showImage(index) {
  images.forEach((image, i) => {
    if (i === index) {
      image.classList.add('active');
    } else {
      image.classList.remove('active');
    }
  });
}

function nextImage() {
  currentImage = (currentImage + 1) % images.length;
  showImage(currentImage);
}

setInterval(nextImage, 3000);

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})


//de chart
