document.addEventListener('DOMContentLoaded', function () {
  let overlay = document.querySelector('.mobile-menu-overlay');
  const navbarToggler = document.querySelector('.navbar-toggler');
  navbarToggler.addEventListener('click', function () {
    overlay.classList.add('active');
    document.body.classList.add('menu-open');
  });

  // Close menu when overlay is clicked
  overlay.addEventListener('click', function () {
    closeMenu();
  });

  // Update closeMenu function to also remove overlay and body class
  window.closeMenu = function () {
    document.getElementById("navbarNav").classList.remove("show");
    overlay.classList.remove('active');
    document.body.classList.remove('menu-open');
  };

  // Make menu-close button use the updated close function
  const menuClose = document.querySelector('.menu-close');
  if (menuClose) {
    menuClose.addEventListener('click', closeMenu);
  }
});


document.addEventListener('DOMContentLoaded', function () {
  const dropdownLinks = document.querySelectorAll('.navbar-nav .dropdown-toggle');
  let clickCount = {}; // Track clicks for each dropdown

  dropdownLinks.forEach(function (link) {
    // Initialize click count for each dropdown
    clickCount[link.textContent] = 0;

    link.addEventListener('click', function (e) {
      // Only apply special behavior on mobile
      if (window.innerWidth < 992) {
        e.preventDefault();
        const dropdownMenu = this.nextElementSibling;

        // Increment click count
        clickCount[this.textContent]++;

        // First click: toggle dropdown
        if (clickCount[this.textContent] === 1) {
          // Toggle dropdown visibility
          if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
          } else {
            dropdownMenu.style.display = 'block';
          }
        }
        // Second click: navigate to the page
        else if (clickCount[this.textContent] === 2) {
          window.location.href = this.getAttribute('href');
          clickCount[this.textContent] = 0; // Reset click count
        }
      }
    });
  });

  // Reset click counts when screen size changes to desktop
  window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
      // Reset all click counts when switching to desktop
      Object.keys(clickCount).forEach(key => {
        clickCount[key] = 0;
      });

      // Reset any inline styles applied to dropdowns
      dropdownLinks.forEach(function (link) {
        const dropdownMenu = link.nextElementSibling;
        if (dropdownMenu) {
          dropdownMenu.style.display = '';
        }
      });
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  // Функция для добавления свайпа мышью к карусели
  function addMouseSwipeToCarousel(carouselId) {
    var carousel = document.getElementById(carouselId);

    if (!carousel) return;

    var carouselInner = carousel.querySelector('.carousel-inner');

    var startX = 0;
    var endX = 0;
    var threshold = 100; // Минимальное расстояние для определения свайпа
    var isDown = false;

    // ======== Обработчики событий мыши ========
    carouselInner.addEventListener('mousedown', function (e) {
      isDown = true;
      startX = e.pageX;
      e.preventDefault();
    });

    carouselInner.addEventListener('mousemove', function (e) {
      if (!isDown) return;
      e.preventDefault();
      endX = e.pageX;
    });

    carouselInner.addEventListener('mouseup', function (e) {
      isDown = false;

      // Определяем направление свайпа
      if (startX - endX > threshold) {
        // Свайп влево - следующий слайд
        var bsCarousel = new bootstrap.Carousel(carousel);
        bsCarousel.next();
      } else if (endX - startX > threshold) {
        // Свайп вправо - предыдущий слайд
        var bsCarousel = new bootstrap.Carousel(carousel);
        bsCarousel.prev();
      }
    });

    carouselInner.addEventListener('mouseleave', function () {
      isDown = false;
    });

    // ======== Обработчики сенсорных событий ========
    carouselInner.addEventListener('touchstart', function (e) {
      startX = e.touches[0].pageX;
    }, { passive: true });

    carouselInner.addEventListener('touchmove', function (e) {
      endX = e.touches[0].pageX;
    }, { passive: true });

    carouselInner.addEventListener('touchend', function () {
      // Определяем направление свайпа для сенсорных устройств
      if (startX - endX > threshold) {
        // Свайп влево - следующий слайд
        var bsCarousel = new bootstrap.Carousel(carousel);
        bsCarousel.next();
      } else if (endX - startX > threshold) {
        // Свайп вправо - предыдущий слайд
        var bsCarousel = new bootstrap.Carousel(carousel);
        bsCarousel.prev();
      }
    });
  }

  // Применяем функцию к обеим каруселям
  addMouseSwipeToCarousel('mainCarousel');
  addMouseSwipeToCarousel('reviewsCarousel');
});

document.addEventListener('DOMContentLoaded', function () {
  // Get all section-advantages sections (there could be multiple on a page)
  var advantageSections = document.querySelectorAll('.section-advantages');

  // Loop through each section
  advantageSections.forEach(function (sectionAdvantages) {
    // Find the carousel within this specific section
    var myCarousel = sectionAdvantages.querySelector('.carousel');

    // Only proceed if carousel exists in this section
    if (myCarousel) {
      var indicators = sectionAdvantages.querySelectorAll('.carousel-indicators button');

      // Event listener for carousel slide
      myCarousel.addEventListener('slid.bs.carousel', function (event) {
        var activeIndex = [...myCarousel.querySelectorAll('.carousel-item')].findIndex(item =>
          item.classList.contains('active')
        );

        indicators.forEach((indicator, index) => {
          if (index === activeIndex) {
            indicator.classList.add('active');
            indicator.setAttribute('aria-current', 'true');
          } else {
            indicator.classList.remove('active');
            indicator.removeAttribute('aria-current');
          }
        });
      });

      // Set initial active indicator
      var initialActiveIndex = [...myCarousel.querySelectorAll('.carousel-item')].findIndex(item =>
        item.classList.contains('active')
      );

      indicators.forEach((indicator, index) => {
        if (index === initialActiveIndex) {
          indicator.classList.add('active');
          indicator.setAttribute('aria-current', 'true');
        } else {
          indicator.classList.remove('active');
          indicator.removeAttribute('aria-current');
        }
      });
    }
  });
});

