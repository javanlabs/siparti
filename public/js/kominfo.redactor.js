            
$(document).ready(function() {
    $(".textRedactor").redactor({
        minHeight: 300,
        imageUpload: '/image/upload',
        plugins : ['imageManager'],
    });
  
    $(".redactor-editor").text("");   
  
    var descriptionText = $(".descriptionText").text();
  
    $(".textRedactor").redactor('code.set', descriptionText);
});
           
