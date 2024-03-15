function addFields(button) {
   let container = button.parentElement.parentElement;
   let newFields = document.createElement("p");
   newFields.innerHTML = '<input type="time" name="times[]" id=""><input type="text" name="times_text[]" id="" placeholder="текст до пункту">';
   container.appendChild(newFields);
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
   let dynamicFields2 = document.querySelector("#dynamicFields2 .time-input");
   let dayVar3Select = document.getElementById("DayVar3");
   let dynamicFields3 = document.querySelector("#dynamicFields3 .time-input");

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

});
