function addFields() {
   let container = document.getElementById("dynamicFields");
   let newFields = document.createElement("p");
   newFields.innerHTML = '<input type="time" name="times[]" id=""><input type="text" name="times_text[]" id="" placeholder="текст до пункту">';
   container.appendChild(newFields);
}
document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   let timetableContainer = document.querySelector('.timetable__flex');
   // timetableContainer.addEventListener('click', function (event) {
   //    if (event.target.classList.contains('timetable__btn')) {
   //       let flexBlocks = document.querySelectorAll('.timetable__flex-block');
   //       let flexBlockIndex = Array.from(flexBlocks).indexOf(event.target.closest('.timetable__flex-block'));
   //       let imgBlock = flexBlocks[flexBlockIndex].querySelector('.timetable__img-block');
   //       let timeBlock = flexBlocks[flexBlockIndex].querySelector('.timetable__time');
   //       if (!isSmallScreen) {
   //          if (imgBlock.style.width === '55%') {
   //             imgBlock.style.width = '74%';
   //             timeBlock.style.opacity = '0';
   //             timeBlock.style.left = '-450px';
   //          } else {
   //             imgBlock.style.width = '55%';
   //             timeBlock.style.opacity = '1';
   //             timeBlock.style.left = '0px';
   //          }
   //       }
   //       else {
   //          if (imgBlock.style.height === '50%') {
   //             imgBlock.style.height = '100%';
   //             timeBlock.style.opacity = '0';
   //             timeBlock.style.top = '-50px';
   //          } else {
   //             imgBlock.style.height = '50%';
   //             timeBlock.style.opacity = '1';
   //             timeBlock.style.top = '0px';
   //          }
   //       }
   //    }

   // });
});
