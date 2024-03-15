let offset = 0;//зсув від лівого краю
let slideIndex = 1;// Поточний індекс слайда
showDots(slideIndex);// Виклик функції показу точки
const sliderLine = document.querySelector('.our-club__slyder-line');
// Обробник події для кнопки "Наступний слайд"
document.querySelector('.our-club__next').addEventListener('click', function () {
   // Збільшення зсуву 
   offset = offset + 1050;
   // Збільшення індексу слайда
   slideIndex++;
   // Перевірка, чи досягнуто кінця слайдів, якщо так, перехід на перший
   if (offset > 6300) {
      offset = 0;
      slideIndex = 1;
   }
   // Зміна стилю для зсуву слайдера
   sliderLine.style.left = -offset + 'px';
   console.log(sliderLine.style.left);
   console.log(slideIndex);
   showDots();
})
// Обробник події для кнопки "Попередній слайд"
document.querySelector('.our-club__prev').addEventListener('click', function () {
   // Зменшення зсуву 
   offset = offset - 1050;
   // Зменшення індексу слайда
   slideIndex--;
   // Перевірка, чи досягнуто початку слайдів, якщо так, перехід на останній
   if (offset < 0) {
      offset = 6300;
      slideIndex = 7;
   }
   sliderLine.style.left = -offset + 'px';
   console.log(sliderLine.style.left);
   console.log(slideIndex);
   showDots();
})
// Обробник події для кліку на точку слайдера
document.querySelector('.our-club__slider-dots').addEventListener('click', function (event) {
   if (event.target.classList.contains('our-club__item')) {
      // Визначення номеру точки та встановіть відповідний slideIndex та offset
      slideIndex = parseInt(event.target.id.replace('dot', ''));
      offset = (slideIndex - 1) * 1050;
      sliderLine.style.left = -offset + 'px';
      showDots();
   }
})
// Функція взаємодії з точкою слайда
function showDots() {
   console.log(offset + 'px');
   console.log(slideIndex);
   // Отримання елементів точок слайдера
   let dots = document.getElementsByClassName("our-club__item");
   // Перебір всіх точок і видалення класу "active"
   for (let i = 0; i < dots.length; i++) {
      dots[i].classList.remove("active-dot");
   }
   // Додавання класу "active" до точки, яка відповідає поточному слайду
   dots[slideIndex - 1].classList.add("active-dot");
}
