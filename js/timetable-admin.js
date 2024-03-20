function addFields(button) {
   let container = button.parentElement.parentElement;
   let blockToClone = container.querySelector('.form__block-grid');
   let newField = blockToClone.cloneNode(true);
   container.appendChild(newField);
}
function removeField(button) {
   let container = button.parentElement.parentElement;
   if (container.childElementCount > 1) {
      container.removeChild(container.lastElementChild);
   }
}
function handleDayVar1Change() {
   let dayVar1Select = document.getElementById("DayVar1");
   let dayVar2Select = document.getElementById("DayVar2");
   let dynamicFields2 = document.querySelector("#dynamicFields2");
   let dayVar3Select = document.getElementById("DayVar3");
   let dynamicFields3 = document.querySelector("#dynamicFields3");
   let formInputText2 = dynamicFields2.querySelectorAll(".form__input-text");
   let formInputText3 = dynamicFields3.querySelectorAll(".form__input-text");

   if (dayVar1Select.value === "Пн-Вс") {
      dayVar2Select.disabled = true;
      dynamicFields2.style.display = "none";
      dayVar3Select.disabled = true;
      dynamicFields3.style.display = "none";
      dayVar2Select.setAttribute("disabled", "disabled");
      dayVar3Select.setAttribute("disabled", "disabled");
      formInputText2.forEach(element => {
         element.setAttribute("disabled", "disabled");
      });
      formInputText3.forEach(element => {
         element.setAttribute("disabled", "disabled");
      });
   } else if (dayVar1Select.value === "Пн-Сб") {
      dayVar2Select.disabled = true;
      dynamicFields2.style.display = "none";
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "flex";
      dayVar3Select.removeAttribute("disabled");
      formInputText3.forEach(element => {
         element.removeAttribute("disabled");
      });
      dayVar2Select.setAttribute("disabled", "disabled");
      formInputText2.forEach(element => {
         element.setAttribute("disabled", "disabled");
      });
   } else if (dayVar1Select.value === "Пн-Пт") {
      dayVar2Select.disabled = false;
      dynamicFields2.style.display = "flex";
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "flex";
      dayVar2Select.removeAttribute("disabled");
      formInputText2.forEach(element => {
         element.removeAttribute("disabled");
      });
      dayVar3Select.removeAttribute("disabled");
      formInputText3.forEach(element => {
         element.removeAttribute("disabled");
      });
      handleDayVar2Change();
   }
}
function handleDayVar2Change() {
   let dayVar2Select = document.getElementById("DayVar2");
   let dayVar3Select = document.getElementById("DayVar3");
   let dynamicFields3 = document.querySelector("#dynamicFields3");
   let formInputText3 = dynamicFields3.querySelectorAll(".form__input-text");

   if (dayVar2Select.value === "Вс-Cб") {
      dayVar3Select.disabled = true;
      dynamicFields3.style.display = "none";
      dayVar2Select.removeAttribute("disabled");
      formInputText2.forEach(element => {
         element.removeAttribute("disabled");
      });
      dayVar3Select.setAttribute("disabled", "disabled");
      formInputText3.forEach(element => {
         element.setAttribute("disabled", "disabled");
      });
   } else if (dayVar2Select.value === "Сб") {
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "grid";
      dayVar2Select.removeAttribute("disabled");
      formInputText2.forEach(element => {
         element.removeAttribute("disabled");
      });
      dayVar3Select.removeAttribute("disabled");
      formInputText3.forEach(element => {
         element.removeAttribute("disabled");
      });
   }
}

handleDayVar1Change();
document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   let timetableContainer = document.querySelector('.timetable__flex');
});
