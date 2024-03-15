document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   let vacanciesContainer = document.querySelector('.vacancies__block');
   vacanciesContainer.addEventListener('mouseover', function (event) {
      let flexBlock = event.target.closest('.vacancies__cart');
      if (flexBlock) {
         let btnBlock = flexBlock.querySelector('.vacancies__cart-btn');
         if (!isSmallScreen) {
            if (btnBlock.style.background === 'rgb(187, 186, 186)') {
               btnBlock.style.background = 'rgb(200, 81, 81)';
               btnBlock.style.justifyContent = 'start';
               flexBlock.classList.add('highlighted');
            } else {
               btnBlock.style.background = 'rgb(187, 186, 186)';
               btnBlock.style.justifyContent = 'end';
               flexBlock.classList.remove('highlighted');
            }
         } else {
            if (btnBlock.style.background === 'rgba(187, 186, 186, 0.4)') {
               btnBlock.style.background = 'rgb(200, 81, 81)';
               btnBlock.style.justifyContent = 'start';
               flexBlock.classList.add('highlighted');
            } else {
               btnBlock.style.background = 'rgba(187, 186, 186, 0.4)';
               btnBlock.style.justifyContent = 'end';
               flexBlock.classList.remove('highlighted');
            }
         }
      }
   });
   vacanciesContainer.addEventListener('mouseout', function (event) {
      let flexBlock = event.target.closest('.vacancies__cart');
      if (flexBlock) {
         let btnBlock = flexBlock.querySelector('.vacancies__cart-btn');
         if (!isSmallScreen) {
            if (btnBlock.style.background === 'rgb(200, 81, 81)') {
               btnBlock.style.background = 'rgb(187, 186, 186)';
               btnBlock.style.justifyContent = 'end';
               flexBlock.classList.remove('highlighted');
            }
         } else {
            if (btnBlock.style.background === 'rgb(200, 81, 81)') {
               btnBlock.style.background = 'rgba(187, 186, 186, 0.4)';
               btnBlock.style.justifyContent = 'end';
               flexBlock.classList.remove('highlighted');
            }
         }
      }
   });

   let plusButton = document.querySelector('.plus__vacancies');
   plusButton.addEventListener('click', function () {
      let lastBlock = vacanciesContainer.querySelector('.vacancies__cart:last-child');
      let clone = lastBlock.cloneNode(true);
      let currentNumber = parseInt(clone.classList[1].slice(-1));
      clone.classList.remove('vacancies__cart' + currentNumber);
      clone.classList.add('vacancies__cart' + (currentNumber + 1));
      vacanciesContainer.appendChild(clone);
   });
});
