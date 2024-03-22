document.addEventListener('DOMContentLoaded', function () {
   // let form = document.querySelector('#resum__vacans');
   nameInput();
   telInput();
   emailInput();
});
function nameInput() {
   let form = document.querySelector('.valid-form');
   let patternName = /^[А-Яа-яЁёІіЇїЄєҐґA-Za-z'` ]+$/;
   let inputName = document.getElementById('nameInput');
   let message = document.querySelector('.form-post__message1');
   inputName.addEventListener('input', function () {
      let textInput = this.value.trim();
      if (textInput !== "") {
         if (patternName.test(textInput)) {
            message.innerHTML = '';
            form.removeAttribute("disabled");
         } else {
            let res = 'ПІ повинні писатися літерами';
            message.innerHTML = res;
            form.setAttribute("disabled", "disabled");
         }
      } else {
         message.innerHTML = '';
         form.setAttribute("disabled", "disabled");
      }
   })
}
function telInput() {
   let form = document.querySelector('.valid-form');
   let patternTel = /^\+380[0-9]{9}$/;
   let inputTel = document.getElementById('telInput');
   let message = document.querySelector('.form-post__message2');
   inputTel.addEventListener('input', function () {
      let numInput = this.value.trim();
      if (numInput !== "") {
         if (patternTel.test(numInput)) {
            message.innerHTML = '';
            form.removeAttribute("disabled");
         } else {
            let res = 'Телефон пишиться лише числами та в форматі +380XXXXXXXXX';
            message.innerHTML = res;
            form.setAttribute("disabled", "disabled");
         }
      } else {
         message.innerHTML = '';
         form.setAttribute("disabled", "disabled");
      }
   })
}
function emailInput() {
   let form = document.querySelector('.valid-form');
   let patternEmail = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
   let noPatternName = /^[А-Яа-яЁёІіЇїЄєҐґA-Za-z'` ]+$/;
   let inputEmail = document.getElementById('emailInput');
   let message = document.querySelector('.form-post__message3');
   inputEmail.addEventListener('input', function () {
      let emInput = this.value.trim();
      if (emInput !== "") {
         if (patternEmail.test(emInput) && !noPatternName.test(emInput)) {
            message.innerHTML = '';
            form.removeAttribute("disabled");
         } else {
            let res = 'Не відповідає стандартам пропису пошти, та можливо містить кирилицю';
            message.innerHTML = res;
            form.setAttribute("disabled", "disabled");
         }
      } else {
         message.innerHTML = '';
         form.setAttribute("disabled", "disabled");
      }
   })
}