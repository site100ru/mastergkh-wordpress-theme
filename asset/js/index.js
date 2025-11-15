document.addEventListener('DOMContentLoaded', function () {
  const toTopBtn = document.querySelector('.to-top-btn');

  toTopBtn.addEventListener('click', function () {
    window.scrollTo({
      top: 0,
      behavior: 'smooth' // плавная прокрутка
    });
  });
});