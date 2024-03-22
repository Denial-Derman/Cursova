document.addEventListener("DOMContentLoaded", function () {
   let price = document.querySelector("#price");
   let formBtn = document.querySelector(".form__btn");
   price.addEventListener("input", function () {
      // Отримуємо значення з input
      let inputValue = price.value;
      if (/^\d+$/.test(inputValue) && !/e/i.test(inputValue) && parseInt(inputValue) >= 0) {
         pricePr.innerText = inputValue;
         errorMessage.innerText = "";
         formBtn.removeAttribute("disabled");
      } else {
         errorMessage.innerText = "Введено невірне значення. Будь ласка, введіть лише додатні числа";
         price.value = "";
         formBtn.removeAttribute("disabled", "disabled");
      }
   });
});

