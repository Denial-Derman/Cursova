document.addEventListener('DOMContentLoaded', function () {
   let trainersContainer = document.querySelector('.trainers__flex');
   let trainersBanner = document.querySelector('.trainers__banner');
   trainersBanner.addEventListener('click', function (event) {
      let trainersBannerOpen = document.querySelector('.trainers__banner-open');
      let trainersBannerClose = document.querySelector('.trainers__banner-close');

      let crossElement = event.target.closest('.cross');
      let downArrowElement = event.target.closest('.down-arrow');
      if (crossElement) {
         trainersBannerOpen.style.opacity = '0';
         trainersBannerClose.style.opacity = '1';
         trainersBannerClose.style.pointerEvents = 'auto';
         trainersBannerOpen.style.height = '0px';
         trainersBannerClose.style.height = '30px';
         trainersBannerOpen.style.width = '720px';
         trainersBannerOpen.style.zIndex = '1';
         trainersBannerClose.style.zIndex = '2';
         trainersBannerOpen.style.top = '-10px';
         trainersBannerClose.style.top = '0px';
      }

      if (downArrowElement) {
         trainersBannerOpen.style.opacity = '1';
         trainersBannerClose.style.opacity = '0';
         trainersBannerClose.style.pointerEvents = 'none';
         trainersBannerClose.style.height = '0px';
         trainersBannerOpen.style.height = '315px';
         trainersBannerOpen.style.width = '100%';
         trainersBannerOpen.style.zIndex = '2';
         trainersBannerClose.style.zIndex = '1';
         trainersBannerOpen.style.top = '-30px';
         trainersBannerClose.style.top = '-40px';
      }
   });

});
