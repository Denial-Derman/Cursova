/* burger */
$(document).ready(function () {
   $('.navigator__burger').click(function (event) {//створення івенту кліку
      $('.navigator__burger,.navigator__punct-menu,.navigator__menu').toggleClass('active');//додавання та видалененя класу до поданих класів при натисканні
   });
   $('.navigator__burger').hover(function (event) {//створення івенту наведення
      $('.navigator__burger,.navigator__punct-menu,.navigator__menu').toggleClass('active1');//додавання та видалененя класу до поданих класів при наведені
   });
});
