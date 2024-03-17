function addFields(button) {
   let container = button.parentElement.parentElement;
   let newFields = document.createElement("p");
   newFields.innerHTML = '<input type="time" name="times[]" id="" required> <input type="text" name="times_text[]" id="" placeholder="текст до пункту" required>';
   container.appendChild(newFields);
   let timeInputs = container.querySelectorAll("input[type='time']");
   let textInputs = container.querySelectorAll("input[type='text']");
   timeInputs.forEach(function (timeInput) {
      timeInput.addEventListener("input", updateTimetable);
   });
   textInputs.forEach(function (textInput) {
      textInput.addEventListener("input", updateTimetable);
   });
}
function removeField(button) {
   let container = button.parentElement.parentElement;
   if (container.childElementCount > 1) {
      container.removeChild(container.lastElementChild);
   }
   updateTimetable();
}
function handleDayVar1Change() {
   let dayVar1Select = document.getElementById("DayVar1");
   let dayVar2Select = document.getElementById("DayVar2");
   let dynamicFields2 = document.querySelector("#dynamicFields2 .time-input");
   let dayVar3Select = document.getElementById("DayVar3");
   let dynamicFields3 = document.querySelector("#dynamicFields3 .time-input");
   let selectedOption = dayVar1Select.options[dayVar1Select.selectedIndex].text;
   let dynamicFields1 = document.querySelector("#dynamicFields1 .time-input");

   if (dayVar1Select.value === "1") {
      dayVar2Select.disabled = true;
      dynamicFields2.style.display = "none";
      dayVar3Select.disabled = true;
      dynamicFields3.style.display = "none";
   } else if (dayVar1Select.value === "2") {
      dayVar2Select.disabled = true;
      dynamicFields2.style.display = "none";
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "block";
   } else if (dayVar1Select.value === "3") {
      dayVar2Select.disabled = false;
      dynamicFields2.style.display = "block";
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "block";
      handleDayVar2Change();
   }
   let timetableList = document.querySelector(".timetable__time");
   timetableList.innerHTML = "";
   let listItem = document.createElement("li");
   listItem.textContent = selectedOption;
   timetableList.appendChild(listItem);
}
function handleDayVar2Change() {
   let dayVar2Select = document.getElementById("DayVar2");
   let dayVar3Select = document.getElementById("DayVar3");
   let dynamicFields3 = document.querySelector("#dynamicFields3 .time-input");

   if (dayVar2Select.value === "1") {
      dayVar3Select.disabled = true;
      dynamicFields3.style.display = "none";
   } else if (dayVar2Select.value === "2") {
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "block";
   }
}

handleDayVar1Change();
document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   let timetableContainer = document.querySelector('.timetable__flex');
   document.querySelector('.custom-file-upload').addEventListener('click', function () {
      document.querySelector('.image-form').click();
   });
   let nameTimeTable = document.querySelector("#nameTimeTable");
   let timeTableBtn = document.querySelector("#timeTableBtn");
   nameTimeTable.addEventListener("input", function () {
      // Отримуємо значення з input
      let inputValue = nameTimeTable.value;
      // Виводимо значення в потрібне місце 
      timeTableBtn.innerText = inputValue;
   });
   let timeInputs = document.querySelectorAll("#dynamicFields1 .time-input input[type='time']");
   let textInputs = document.querySelectorAll("#dynamicFields1 .time-input input[type='text']");

   // Функция для проверки заполнения всех полей
   function checkFields() {
      // Флаг для отслеживания заполнения всех полей
      let isAllFieldsFilled = true;

      // Перебираем все поля для времени и текста
      timeInputs.forEach(function (timeInput, index) {
         let time = timeInput.value;
         let text = textInputs[index].value;

         // Если хотя бы одно поле не заполнено, устанавливаем флаг в false
         if (!time || !text) {
            isAllFieldsFilled = false;
         }
      });

      // Возвращаем результат проверки
      return isAllFieldsFilled;
   }

   // Функция для обновления списка с расписанием
   function updateTimetable() {
      // Очищаем список
      let timetableList = document.querySelector(".timetable__time");
      timetableList.innerHTML = "";

      // Получаем выбранный день недели
      let dayVar1Select = document.getElementById("DayVar1");
      let selectedOption = dayVar1Select.options[dayVar1Select.selectedIndex].text;

      // Создаем элемент списка для выбранного дня
      let listItem = document.createElement("li");
      listItem.textContent = selectedOption;
      timetableList.appendChild(listItem);

      // Проверяем, заполнены ли все поля, и добавляем элементы в список
      if (checkFields()) {
         timeInputs.forEach(function (timeInput, index) {
            let time = timeInput.value;
            let text = textInputs[index].value;

            // Создаем элемент списка для времени и текста
            let listItem = document.createElement("li");
            listItem.textContent = time + " - " + text;
            timetableList.appendChild(listItem);
         });
      }
   }

   // Обновляем список с расписанием при загрузке страницы
   updateTimetable();

   // Добавляем обработчики событий input для полей ввода времени и текста
   timeInputs.forEach(function (timeInput) {
      timeInput.addEventListener("input", updateTimetable);
   });

   textInputs.forEach(function (textInput) {
      textInput.addEventListener("input", updateTimetable);
   });
});
