document.addEventListener('DOMContentLoaded', function () {
   const isSmallScreen = window.matchMedia('(max-width: 900px)').matches;
   const blockClub = document.querySelector('.club__row');
   let isGrabbed = false;
   let startX;
   let scrollLeft;

   const handleMouseDown = (event) => {
      event.preventDefault();
      isGrabbed = true;
      startX = event.pageX - blockClub.offsetLeft;
      scrollLeft = blockClub.scrollLeft;
      blockClub.style.cursor = 'grabbing';

   };

   const handleMouseUp = (e) => {
      e.preventDefault();
      isGrabbed = false;
      blockClub.style.cursor = 'grab';
   };


   const handleMouseMove = (e) => {
      if (!isGrabbed) return;
      e.preventDefault();
      const x = e.pageX - blockClub.offsetLeft;
      blockClub.scrollLeft = scrollLeft - (x - startX);
      blockClub.style.cursor = 'grab';
   };
   if (isSmallScreen) {
      blockClub.addEventListener('mousedown', handleMouseDown);
      blockClub.addEventListener('mouseup', handleMouseUp);
      blockClub.addEventListener('mousemove', handleMouseMove);
   }
})