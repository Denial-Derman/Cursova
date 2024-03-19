function addFields(button) {
   let container = button.parentElement.parentElement;
   let newField = document.createElement("div");
   newField.className = "form__block form__block-grid";
   newField.innerHTML = '<input type="time" name="times[]" class="form__input-text form__input-time" required>' +
      '<input type="text" name="times_text[]" class="form__input-text" placeholder="Примітка" required>';
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

   if (dayVar1Select.value === "1") {
      dayVar2Select.disabled = true;
      dynamicFields2.style.display = "none";
      dayVar3Select.disabled = true;
      dynamicFields3.style.display = "none";
   } else if (dayVar1Select.value === "2") {
      dayVar2Select.disabled = true;
      dynamicFields2.style.display = "none";
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "flex";
   } else if (dayVar1Select.value === "3") {
      dayVar2Select.disabled = false;
      dynamicFields2.style.display = "flex";
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "flex";
      handleDayVar2Change();
   }
}
function handleDayVar2Change() {
   let dayVar2Select = document.getElementById("DayVar2");
   let dayVar3Select = document.getElementById("DayVar3");
   let dynamicFields3 = document.querySelector("#dynamicFields3");

   if (dayVar2Select.value === "1") {
      dayVar3Select.disabled = true;
      dynamicFields3.style.display = "none";
   } else if (dayVar2Select.value === "2") {
      dayVar3Select.disabled = false;
      dynamicFields3.style.display = "grid";
   }
}

handleDayVar1Change();
document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   let timetableContainer = document.querySelector('.timetable__flex');
});
