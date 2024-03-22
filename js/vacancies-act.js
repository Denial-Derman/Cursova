document.addEventListener('DOMContentLoaded', function () {
   nameInput();
   telInput();
   emailInput();
   const isSmallScreen = window.matchMedia('(max-width: 1000px)').matches;
   let vacanciesCart = document.querySelector('.vacancies__cart');
   let vacanciesBtnText = document.querySelector('.vacancies__cart-btn-text');
   let vacanciesBtn = document.querySelector('.vacancies__cart-btn');
   let vacanciesFormBtn = document.querySelector('.vacancies__cart-form button');
   vacanciesBtn.addEventListener('click', function (event) {
      event.preventDefault();
      let vacanciesImage = document.querySelector('.vacancies__cart-image');
      if (vacanciesImage.style.left === '0%') {
         vacanciesImage.style.left = '50%';
      }
      else {
         vacanciesImage.style.left = '0%';
      }
   });
   vacanciesBtn.addEventListener('mouseenter', function (event) {
      vacanciesBtn.style.background = 'rgb(200, 81, 81)';
      vacanciesBtn.style.fontSize = '24px';
   });
   vacanciesBtn.addEventListener('mouseleave', function (event) {
      vacanciesBtn.style.background = 'rgba(187, 186, 186, 0.525)';
      vacanciesBtn.style.fontSize = '20px';
   });

   vacanciesFormBtn.addEventListener('mouseenter', function (event) {
      vacanciesFormBtn.style.background = 'rgb(200, 81, 81)';
      vacanciesFormBtn.style.fontSize = '24px';
      vacanciesFormBtn.style.color = '24px';
   });
   vacanciesFormBtn.addEventListener('mouseleave', function (event) {
      vacanciesFormBtn.style.background = 'rgb(171, 171, 171)';
      vacanciesFormBtn.style.fontSize = '20px';
      vacanciesFormBtn.style.color = '24px';
   });

   const vacanciesTabs = document.querySelectorAll('.vacancies__mob-el');
   const descriptionBlock = document.querySelector('.vacancies__cart-description');
   const formBlock = document.querySelector('.vacancies__cart-form');

   vacanciesTabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
         vacanciesTabs.forEach(function (otherTab) {
            otherTab.classList.remove('act-title');
         });
         tab.classList.add('act-title');
         if (tab.textContent === 'Умови') {
            descriptionBlock.classList.add('act-block');
            formBlock.classList.remove('act-block');
         } else if (tab.textContent === 'Заявки') {
            formBlock.classList.add('act-block');
            descriptionBlock.classList.remove('act-block');
         }
      });
   });
});




