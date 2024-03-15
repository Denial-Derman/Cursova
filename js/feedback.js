document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   const feedbackBtn = document.querySelectorAll('.feedbackOpen');
   const wrapperBlock = document.querySelector('.wrapper');
   const feedbackFormHTML = '<div class="feedback">   <form action="#" method="post" class="feedback__form">  <div class="feedback__form-close"><img src="img/feedback/close.svg" alt=""></div>  <div class="feedback__form-title"> <h2>Залишити контакти</h2> <p>Напишіть ваш номер телефону, щоб ми могли з вами зв’язатися</p>  </div> <div class="feedback__form-content">   <div class="feedback__form-name">  <p>Ім’я:</p>  <input type="text" name="feedbackName" id="feedbackName" placeholder="Ім’я"                        class="feedback__form-input"> </div>  <div class="feedback__form-number">   <p>Телефон:</p>  <input type="tel" name="feedbackNumber" id="feedbackNumber" placeholder="+380(00)-000-00-00"   class="feedback__form-input">  </div>  <div class="feedback__form-send"> <button type="submit" class="feedback__form-input feedback__form-btn">Надіслати</button>  </div>   </div> </form> </div>';
   feedbackBtn.forEach(function (feedbackBtnClick) {
      feedbackBtnClick.addEventListener('click', function (event) {
         event.preventDefault();
         console.log("Button clicked!");
         wrapperBlock.insertAdjacentHTML('afterbegin', feedbackFormHTML);
         console.log("Block Open!");
         const feedbackBtnClose = document.querySelector('.feedback__form-close img');
         const feedbackBlock = document.querySelector('.feedback');
         const feedbackForm = feedbackBlock.querySelector('.feedback__form');
         feedbackBtnClose.addEventListener('click', function () {
            const feedbackBlock = document.querySelector('.feedback');
            if (feedbackBlock) {
               feedbackBlock.remove();
               console.log("Block Close!");
            }
         });
         feedbackBlock.addEventListener('click', function (feedbackClose) {
            if (!feedbackForm.contains(feedbackClose.target)) {
               feedbackBlock.remove();
            }
         });
      })
   })
})