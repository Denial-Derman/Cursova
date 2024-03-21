function updateFileName(input) {
   if (input.files.length > 0) {
      document.getElementById('imageName').value = input.files[0].name;
   } else {
      document.getElementById('imageName').value = '';
   }
}
document.getElementById('image').addEventListener('change', function (e) {
   updateFileName(this);
});