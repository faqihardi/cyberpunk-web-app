document.addEventListener("DOMContentLoaded", () => {
    console.log("Cyberpunk UI Loaded");

    // --------------------------------------------------
    // GENERAL GALLERY SLIDER (HANYA JALAN JIKA ADA ".slide")
    // --------------------------------------------------
    const slides = document.querySelectorAll(".slide");
    if (slides.length > 0) {
        let currentSlide = 0;
        const navBtnRight = document.querySelectorAll(".nav-btn.right");
        const navBtnLeft = document.querySelectorAll(".nav-btn.left");

        navBtnRight.forEach(btn => btn.addEventListener("click", nextSlide));
        navBtnLeft.forEach(btn => btn.addEventListener("click", prevSlide));

        showSlide(currentSlide);

        function showSlide(index) {
            slides.forEach(s => s.classList.remove("active"));
            if (slides[index]) {
                slides[index].classList.add("active");
            }
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }
    }

    // --------------------------------------------------
    // CHARACTER SLIDER — KHUSUS HALAMAN CHARACTER
    // --------------------------------------------------
    if (document.body.classList.contains("character-page")) {

        let charIndex = 0;
        const charSlides = document.querySelectorAll(".char-slide");

        console.log("Character slides:", charSlides.length);

        if (charSlides.length > 0) {
            showCharSlide(charIndex);
        }

        window.charNext = function () {
            charIndex = (charIndex + 1) % charSlides.length;
            showCharSlide(charIndex);
        };

        window.charPrev = function () {
            charIndex = (charIndex - 1 + charSlides.length) % charSlides.length;
            showCharSlide(charIndex);
        };

        function showCharSlide(i) {
            charSlides.forEach(s => s.classList.remove("active"));
            charSlides[i].classList.add("active");
        }
    }
});

let currentDistrictSlide = 0;
const districtSlides = document.querySelectorAll('.district-slide');
const indicators = document.querySelectorAll('.indicator');
const totalSlides = districtSlides.length;

// Function untuk show slide tertentu
function showDistrictSlide(index) {
    // Reset semua slide
    districtSlides.forEach(slide => {
        slide.classList.remove('active');
    });
    
    // Reset semua indicator
    indicators.forEach(indicator => {
        indicator.classList.remove('active');
    });
    
    // Handle wrapping (kembali ke awal/akhir)
    if (index >= totalSlides) {
        currentDistrictSlide = 0;
    } else if (index < 0) {
        currentDistrictSlide = totalSlides - 1;
    } else {
        currentDistrictSlide = index;
    }
    
    // Show slide yang dipilih
    districtSlides[currentDistrictSlide].classList.add('active');
    indicators[currentDistrictSlide].classList.add('active');
}

// Function next slide
function districtNext() {
    showDistrictSlide(currentDistrictSlide + 1);
}

// Function previous slide
function districtPrev() {
    showDistrictSlide(currentDistrictSlide - 1);
}

// Function go to specific slide (dari indicator dots)
function goToSlide(index) {
    showDistrictSlide(index);
}

// Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (document.querySelector('.districts-page')) {
        if (e.key === 'ArrowRight') {
            districtNext();
        } else if (e.key === 'ArrowLeft') {
            districtPrev();
        }
    }
});

// Touch/Swipe support untuk mobile
let touchStartX = 0;
let touchEndX = 0;

const slider = document.querySelector('.districts-slider');

if (slider) {
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
}

function handleSwipe() {
    const swipeThreshold = 50;
    
    if (touchEndX < touchStartX - swipeThreshold) {
        // Swipe left - next slide
        districtNext();
    }
    
    if (touchEndX > touchStartX + swipeThreshold) {
        // Swipe right - previous slide
        districtPrev();
    }
}

// districts

let autoPlayInterval;

function startAutoPlay() {
    autoPlayInterval = setInterval(() => {
        districtNext();
    }, 5000); // Ganti slide setiap 5 detik
}

function stopAutoPlay() {
    clearInterval(autoPlayInterval);
}

// Start auto-play saat halaman load
if (document.querySelector('.districts-page')) {
    startAutoPlay();
    
    // Stop auto-play saat user interact
    document.querySelector('.districts-slider').addEventListener('mouseenter', stopAutoPlay);
    document.querySelector('.districts-slider').addEventListener('mouseleave', startAutoPlay);
}
