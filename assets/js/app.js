// Dark mode toggle functionality
const darkModeCheckbox = document.querySelector("#dark-mode-checkbox");
const darkModeButton = document.querySelector("#dark-mode-button");

// Initialize checkbox state based on current dark mode
if (darkModeCheckbox) {
    const isDarkMode = document.documentElement.classList.contains("dark");
    darkModeCheckbox.checked = isDarkMode;
}

// Add event listeners
if (darkModeButton) {
    darkModeButton.addEventListener("click", toggleDarkMode);
}
if (darkModeCheckbox) {
    darkModeCheckbox.addEventListener("change", toggleDarkMode);
}

function toggleDarkMode() {
    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("darkMode", "false");
        if (darkModeCheckbox) {
            darkModeCheckbox.checked = false;
        }
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("darkMode", "true");
        if (darkModeCheckbox) {
            darkModeCheckbox.checked = true;
        }
    }
}

const singleSwiperSlider = new Swiper(".single-swiper-slider", {
    spaceBetween: 20,
    slidesPerView: 1,
    loop: true,
    effect: "creative",
    creativeEffect: {
        prev: {
            shadow: true,
            translate: [0, 0, -400],
        },
        next: {
            translate: ["100%", 0, 0],
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
});

const col3SwiperSlider = new Swiper(".col3-swiper-slider", {
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        992: {
            slidesPerView: 3,
        },
        576: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1,
        },
    },
});

const col4SwiperSlider = new Swiper(".col4-swiper-slider", {
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        992: {
            slidesPerView: 4,
        },
        768: {
            slidesPerView: 3,
        },
        480: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1,
        },
    },
});

const autoSwiperSlider = new Swiper(".auto-swiper-slider", {
    slidesPerView: "auto",
    spaceBetween: 30,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

const cardSwiperSlider = new Swiper(".card-swiper-slider", {
    effect: "cards",
    grabCursor: true,
    autoplay: {
        delay: 3000,
    },
    cardsEffect: {
        rotate: 50,
        slideShadows: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

const players = document.querySelectorAll(".js-player");

if (players) {
    Array.from(players).map(
        (p) =>
            new Plyr(p, {
                // options
            })
    );
}

const scrollToTopBtn = document.getElementById("scrollToTopBtn");

if (scrollToTopBtn) {
    scrollToTopBtn.addEventListener("click", function (event) {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
}
