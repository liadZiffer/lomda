/**
 * APP JS
 */

 /**
  * upload image - advertiser page
  */
  $(document).on("click", "i.del" , function() {
      $(this).parent().remove();
  });
  $(function() {
      $(document).on("change",".uploadFile", function()
      {
              var uploadFile = $(this);
          var files = !!this.files ? this.files : [];
          if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
   
          if (/^image/.test( files[0].type)){ // only image file
              var reader = new FileReader(); // instance of the FileReader
              reader.readAsDataURL(files[0]); // read the local file
   
              reader.onloadend = function(){ // set image data as background of div
                  //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
  uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
              }
          }
        
      });
  });

  /**
   * advertiser form validation
   */
  var $form = $("form"),
  $successMsg = $(".alert");
$.validator.addMethod("letters", function(value, element) {
  return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
});
$form.validate({
  rules: {
    name: {
      required: true,
      minlength: 2,
      letters: true
    },
    businessName: {
      required: true,
      minlength: 2
    },
    surname: {
        required: true,
        minlength: 2,
        letters: true
    },
    businessEmail: {
        required: true,
        minlength: 2,
        email:true
      },
      website: {
        required: true
      },
      phone: {
        required: true,
        phone:true
      },
      image: {
        required: true
      }
  },

  messages: {
    name: "יש למלא שם פרטי",
    businessName: "יש למלא שם חברה",
    surname: "יש למלא שם משפחה",
    website: "יש למלא כתובת דף הבית",
    phone: "יש למלא טלפון פרטי/ חברה",
    businessEmail: "יש למלא כתובת אימייל",
    image: "יש לעלות תמונה של פרסומת"
  },
  submitHandler: function() {
    $successMsg.show();
  }
});

