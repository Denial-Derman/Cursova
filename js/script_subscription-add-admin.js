document.addEventListener("DOMContentLoaded", function () {
   let nameSub = document.querySelector("#namesubscription");
   let price = document.querySelector("#price");
   let currency = document.querySelector("#currency");
   let nameElement = document.querySelector("#nameelement");
   let vudalutu = document.querySelector("#vudalutu");
   let dodatu = document.querySelector("#dodatu");
   let vudalElem = document.querySelector(".subscription__body_admin-list__body");

   let nameSubPr = document.querySelector("#prnameSub");
   let nameElementPr = document.querySelector("#elment");
   let pricePr = document.querySelector("#prprice");
   let currencyPr = document.querySelector("#prcurrency");

   let btnClear = document.querySelector("#btnClear");//очищення всього
   let errorMessage = document.querySelector("#error-message");
   nameSub.addEventListener("input", function () {
      // Отримуємо значення з input
      let inputValue = nameSub.value;
      // Виводимо значення в потрібне місце 
      nameSubPr.innerText = inputValue;
   });
   price.addEventListener("input", function () {
      // Отримуємо значення з input
      let inputValue = price.value;
      if (/^\d+$/.test(inputValue) && !/e/i.test(inputValue) && parseInt(inputValue) >= 0) {
         pricePr.innerText = inputValue;
         errorMessage.innerText = "";
      } else {
         alert("Введено невірне значення. Будь ласка, введіть лише додатні числа.");
         price.value = "";
      }
   });
   currency.addEventListener("change", function () {
      // Отримуємо значення з change
      console.log("Событие change сработало");
      let selectedCurrency = currency.options[currency.selectedIndex].text;
      console.log("Выбранная валюта:", selectedCurrency);
      // Виводимо значення в потрібне місце
      currencyPr.innerText = selectedCurrency;
   });
   // Встановлюємо початкове значення валюти
   let initialCurrency = currency.options[currency.selectedIndex].text;
   currencyPr.innerText = initialCurrency;
   let checkTimeNo = document.querySelector("#checkTimeNot");//radiobutton
   let checkTimeYes = document.querySelector("#checkTimeYes");//radiobutton
   let checkTimeYesTimes = document.querySelector("#checkTimeYesTimes");//checkbox
   let checkTimeYesDates = document.querySelector("#checkTimeYesDates");//checkbox
   let checkTimeStart = document.querySelector("#checkTimeStart");//time
   let checkTimeEnd = document.querySelector("#checkTimeEnd");//time
   let checkDayStart = document.querySelector("#checkDateStart");//date
   let checkDayEnd = document.querySelector("#checkDateEnd");//date
   let divTimeCheck = document.querySelector("#durationTimeSub");
   // Функція для блокування/розблокування полів часу та дати
   function toggleTimeAndDateFields(isEnabled) {
      let elements = [checkTimeYesTimes, checkTimeYesDates, checkTimeStart, checkTimeEnd, checkDayStart, checkDayEnd];
      let color = isEnabled ? "" : "gray";
      elements.forEach(element => {
         element.disabled = !isEnabled;
         element.style.color = color;
      });
   }

   // Функція для встановлення чекбокса при редагуванні часу або дати
   function setCheckboxOnEdit(event, checkbox) {
      checkbox.checked = true;
      toggleTimeAndDateFields(true);
   }

   // Встановлення початкового стану (відключено, бо не вибрано checkTimeYes)
   toggleTimeAndDateFields(false);

   // Додаємо обробники подій для радіокнопок
   checkTimeNo.addEventListener("change", function () {
      toggleTimeAndDateFields(false);
      divTimeCheck.innerHTML = "";
   });

   checkTimeYes.addEventListener("change", function () {
      toggleTimeAndDateFields(true);
      updateDateTimeOutput();
   });



   // Обробник події для будь-яких змін у полях вводу часу та дати
   [checkTimeStart, checkTimeEnd, checkDayStart, checkDayEnd].forEach(input => {
      input.addEventListener("input", function () {
         updateDateTimeOutput(); // Оновлюємо вивід дати та часу при кожній зміні
      });
   });
   // Функція для форматування дати в ДД-ММ-РРРР
   function formatDate(dateString) {
      const options = { day: "2-digit", month: "2-digit", year: "numeric" };

      // Перевірка, чи введена дата є правильною
      const parsedDate = new Date(dateString);
      if (!isNaN(parsedDate) && parsedDate.toString() !== "Invalid Date") {
         return parsedDate.toLocaleDateString(undefined, options);
      } else {
         // Якщо дата не введена правильно, можна повернути порожню строку або інший значення за вибором
         return "";
      }
   }

   checkTimeYesTimes.addEventListener("change", function () {
      if (!checkTimeYesTimes.checked) {
         // Якщо чекбокс вимкнений, встановлюємо значення в порожній рядок
         checkTimeStart.value = "";
         checkTimeEnd.value = "";
         updateDateTimeOutput();
      }
   });

   checkTimeYesDates.addEventListener("change", function () {
      if (!checkTimeYesDates.checked) {
         // Якщо чекбокс вимкнений, встановлюємо значення в порожній рядок
         checkDayStart.value = "";
         checkDayEnd.value = "";
         updateDateTimeOutput();
      }
   });

   function updateDateTimeOutput() {
      let newDateStart = formatDate(checkDayStart.value);
      let newDateEnd = formatDate(checkDayEnd.value);
      let newTimeStart = checkTimeStart.value !== "" ? "(" + checkTimeStart.value + ")" : "";
      let newTimeEnd = checkTimeEnd.value !== "" ? "(" + checkTimeEnd.value + ")" : "";
      // Очищаємо попередні елементи в divTimeCheck
      divTimeCheck.innerHTML = "";

      // Додаємо новий елемент в кінець блоку
      let newElement = document.createElement("div");
      newElement.classList.add("subscription__body_admin-list__element");
      newElement.innerHTML = `Діє з:  ${newDateStart} ${newTimeStart}   до:  ${newDateEnd} ${newTimeEnd}`;
      divTimeCheck.appendChild(newElement);
   }


   // Додаємо обробники подій для полів часу та дати
   checkTimeStart.addEventListener("input", function (event) {
      setCheckboxOnEdit(event, checkTimeYesTimes);
   });

   checkTimeEnd.addEventListener("input", function (event) {
      setCheckboxOnEdit(event, checkTimeYesTimes);
   });

   checkDayStart.addEventListener("input", function (event) {
      setCheckboxOnEdit(event, checkTimeYesDates);
   });

   checkDayEnd.addEventListener("input", function (event) {
      setCheckboxOnEdit(event, checkTimeYesDates);
   });

   let buttonClicked = false;
   dodatu.addEventListener("click", function () {
      // Встановлюємо прапорець в true
      let inputText = nameElement.value.trim();
      if (inputText === "") {
         return;
      }
      if (!buttonClicked) {
         let newListItem = document.createElement("li");
         newListItem.textContent = inputText;
         newListItem.contentEditable = true; // Встановлюємо атрибут для редагування
         nameElementPr.appendChild(newListItem);
         buttonClicked = true;
      }
      // Отримуємо введене значення
      let newElementText = nameElement.value;
      // Знаходимо останній елемент списку
      let lastListItem = nameElementPr.lastElementChild;
      // Перевіряємо, чи існує останній елемент та чи є він <li>
      if (lastListItem && lastListItem.tagName === "LI") {
         // Оновлюємо текст останнього елемента
         lastListItem.textContent = newElementText;
      }
      // Створюємо новий елемент
      let newElement = document.createElement("div");
      newElement.classList.add("subscription__body_admin-list__element");
      newElement.innerHTML = `
      <div class="name">Пункт</div>
      <div class="text-el"><input type="text" name="SubscriptionName" placeholder="Введіть елмент списку" value="${newElementText}"></div>
      <div class="subscription__body_admin-list__btn"><img src="img/icon/vudalutu.svg" alt="Видалити елемент" class="vudalutu"></div>`;
      // Додаємо новий елемент в кінець блоку
      vudalElem.appendChild(newElement);

      // Очищаємо поле вводу
      nameElement.value = "";
   });

   // Скидаємо прапорець, коли фокус виходить із поля вводу
   nameElement.addEventListener("blur", function () {
      buttonClicked = false;
   });

   vudalElem.addEventListener("click", function (event) {
      // Перевіряємо, чи була натискана кнопка "Видалити елемент"
      if (event.target.classList.contains("vudalutu")) {
         // Отримуємо батьківський елемент і видаляємо його
         let elementToRemove = event.target.closest(".subscription__body_admin-list__element");
         if (elementToRemove) {
            // Отримуємо текст з відповідного input
            let correspondingInput = elementToRemove.querySelector('input[name="SubscriptionName"]');
            let inputValue = correspondingInput ? correspondingInput.value : "";
            // Видаляємо з блоку vudalElem
            vudalElem.removeChild(elementToRemove);
            // Видаляємо відповідний елемент з блоку nameElementPr
            let listItems = nameElementPr.querySelectorAll("li");
            for (let listItem of listItems) {
               if (listItem.textContent === inputValue) {
                  nameElementPr.removeChild(listItem);
                  break; // Якщо елемент знайдено та видалено, виходимо із циклу
               }
            }

         }
      }
   });
   function clearInputFields() {
      // Очищаем значения всех полей ввода
      nameSub.value = "";
      price.value = "000";
      // Очищаем выбранный вариант валюты
      currency.selectedIndex = 0;
      // Очищаем текстовое поле ввода nameElement
      nameElement.value = "";
      // Очищаем блоки с отображением введенных данных
      nameSubPr.innerText = "Назва Абонемента";
      pricePr.innerText = "000";
   }

   function clearRadioButtons() {
      // Скидаємо значення радіокнопок
      checkTimeNo.checked = false;
      checkTimeYes.checked = false;
   }

   function clearCheckboxes() {
      // Скидаємо значення чекбоксів
      checkTimeYesTimes.checked = false;
      checkTimeYesDates.checked = false;
      toggleTimeAndDateFields(false);
   }

   function clearTimeAndDateFields() {
      // Скидаємо значення полів часу та дати
      checkTimeStart.value = "";
      checkTimeEnd.value = "";
      checkDayStart.value = "";
      checkDayEnd.value = "";
   }

   btnClear.addEventListener("click", function () {
      clearInputFields();
      clearRadioButtons();
      clearCheckboxes();
      clearTimeAndDateFields();

      // Очистка списку з елементами
      divTimeCheck.innerHTML = "";
      // Видаляємо всі додані елементи в списку nameElementPr
      let listItems = nameElementPr.querySelectorAll("li");
      for (let listItem of listItems) {
         nameElementPr.removeChild(listItem);
      }

      // Видаляємо лише ті елементи з блоку vudalElem, які відповідають заданій структурі
      let addedElements = vudalElem.querySelectorAll(".subscription__body_admin-list__element");
      for (let addedElement of addedElements) {
         let nameElement = addedElement.querySelector(".name");
         let textInput = addedElement.querySelector('input[name="SubscriptionName"]');
         if (nameElement && textInput) {
            let elementText = textInput.value.trim();
            if (nameElement.textContent === "Пункт" && elementText !== "") {
               vudalElem.removeChild(addedElement);
            }
         }
      }
   });

});

