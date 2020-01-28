$(document).ready(function($) {//start

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });
    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
      $('.navbar-collapse').collapse('hide');
    });
      // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 56
  });
  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);


/**
 * 
NAVBAR FIXED
*/
$(window).on("scroll", function() {
  if ($(window).scrollTop() >= 400) {
    $(".navbar").addClass("compressed");
  } else {
    $(".navbar").removeClass("compressed");
  }
});
/**
 * NAVBAR CUSTOM STYLE
 */
$('#nav-icon1').click(function(){
  $(this).toggleClass('open');
});

/**
 * BUTTON TO TOP SETTINGS
 */
var btn = $('#button-to-top');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '1000');
});
/**
 * APP JS
 */
// $(window).on('resize', function () {
//   $('.ul-register-login').toggleClass('mx-auto justify-content-center', $(window).width() < 768);
// });
if($(window).width() < 769){
  $('.inner-icon,.laptop-img,.text-info-simulators,.number-info').removeClass('wow');
  $('.navbar').removeClass('fixed-top');
}
new WOW().init();
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
  var $form = $("#advform"),
  $successMsg = $(".alert");
$.validator.addMethod("letters", function(value, element) {
  return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
});
$form.validate({
  rules: {
    firstName: {
      required: true,
      minlength: 2,
      letters: true
    },
    businessName: {
      required: true,
      minlength: 2
    },
    lastName: {
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
      file: {
        required: true
      }
  },

  messages: {
    firstName: "יש למלא שם פרטי",
    businessName: "יש למלא שם חברה",
    lastName: "יש למלא שם משפחה",
    website: "יש למלא כתובת דף הבית",
    phone: "יש למלא טלפון פרטי/ חברה",
    businessEmail: "יש למלא כתובת אימייל",
    file: "יש לעלות תמונה של פרסומת"
  },
  submitHandler: function() {
    $successMsg.show();
  }
});

$('#advertiser-main').keydown(function(e){
    if (e.keyCode == 65 && e.ctrlKey) {
        e.target.select()
    }

})
  /**
   * advertiser form validation
   */
  var $form = $("#advertisingForm"),
  $successMsg = $(".alert");
$.validator.addMethod("letters", function(value, element) {
  return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
});
$form.validate({
  rules: {
    advertisingName: {
      required: true,
      minlength: 5,
      letters: true
    },
    idcity: {
      required: true
    },
    slogen: {
        required: true,
        minlength: 5,
        letters: true
    },
    shortSlogen: {
        required: true,
        minlength: 5,
        email:true
      },
      idSubjectQuestion: {
        required: true,
        option:true
      },
      startDate: {
        required: true
      },
      endDate: {
        required: true
      }
  },

  messages: {
    advertisingName: "יש למלא שם פרסומת",
    idcity: "יש לבחור ערים/ או עיר",
    slogen: "נא לבחור סלוגן לפרסומת",
    shortSlogen: "נא לבחור סלוגן קצר לפרסומת",
    idSubjectQuestion: "בחרו נושא שבו תופיע הפסרומת",
    startDate: "יש לציין תאריך התחלה",
    endDate: "יש לציין תאריך סיום "
  },
  submitHandler: function() {
    $successMsg.show();
  }
});

$('#advertisingForm').keydown(function(e){
    if (e.keyCode == 65 && e.ctrlKey) {
        e.target.select()
    }

})



        //register-form handler
        $(function() {
          $('#register-form').on('submit', function(e) {
              e.preventDefault();
              valid = true;//default login flag
              if ($('#firstName').val() == '') {
                message = "הזינו שם פרטי";
                valid = false;
              }
              else if ($('#lastName').val() == '') {
                  message = "הזינו שם משפחה";
                  valid = false;
              }
              else if ($('email-register').val() == '') {
                message = "הזינו כתובת אימייל";
                valid = false;
              }
              else if ($('#idcity-register').val() == '') {
                message = "בחרו עיר מהרשימה";
                valid = false;
              }
              else if ($('#iduserType').val() == '') {
                message = "בחרו סוג משתמש";
                valid = false;
              }
              if (!valid) {//if valid is false
                  $('.show_msg-register').css("text-align", "center");
                  $('.show_msg-register').css("color", "#F14141");
                  $('.show_msg-register').css("font-weight", "bold");
                  $('.show_msg-register').css("padding-left", "3%");
                  $('.show_msg-register').html(message);
                  return valid;
              }
              
              $.ajax({
                  type: 'post',
                  url: 'http://localhost/lomda/register-handler.php',
                  data: $('#register-form').serialize(),
                  success: function(data) {
                      var message = data;
                      alert(message);
                      if ((message.indexOf('user') >= 0) ) { //check if user 
                          window.location.replace("subjects.php");
                      } 
                      else if ((message.indexOf('user') >= 0) ) { //check if user admin
                        window.location.replace("./admin/index.php");
                      }
                      else if ((message.indexOf('advertiser') >= 0) ) { //check if advertiser
                        window.location.replace("advertiserMainRoute.php");
                      }
                      else {//error
                          $('.show_msg-register').css("text-align", "center");
                          $('.show_msg-register').css("color", "#F14141");
                          $('.show_msg-register').css("font-weight", "600");
                          $('.show_msg-register').css("padding-left", "0");
                          $('.show_msg-register').css("width", "100%");
                          $('.show_msg-register').html(message);
                      }
                  }
              });
          });
      });


        //login-form handler
        $(function() {
          $('#login-form').on('submit', function(e) {
              e.preventDefault();
              valid = true;//default login flag
              if ($('#email-login').val() == '') {
                  message = "Please enter a username";
                  valid = false;
              }
              else if ($('#password-login').val() == '' && valid) {//if password false and username true
                  message = "Please enter a password";
                  valid = false;
              }
              if (!valid) {//if valid is false
                  $('.show_msg').css("text-align", "center");
                  $('.show_msg').css("color", "#F14141");
                  $('.show_msg').css("font-weight", "bold");
                  $('.show_msg').css("padding-left", "3%");
                  $('.show_msg').html(message);
                  console.log("valid is..."+valid);
                  return valid;
              }
              
              $.ajax({
                  type: 'post',
                  url: 'http://localhost/lomda/login-handler.php',
                  data: $('#login-form').serialize(),
                  success: function(data) {
                      var message = data;
                      if ((message.indexOf('user') >= 0) ) { //check if user 
                          window.location.replace("subjects.php");
                      } 
                      else if ((message.indexOf('user') >= 0) ) { //check if user admin
                        window.location.replace("./admin/index.php");
                      }
                      else if ((message.indexOf('advertiser') >= 0) ) { //check if advertiser
                        window.location.replace("advertiserMainRoute.php");
                      }
                      else {//error
                          $('.show_msg').css("text-align", "center");
                          $('.show_msg').css("color", "#F14141");
                          $('.show_msg').css("font-weight", "600");
                          $('.show_msg').css("padding-left", "0");
                          $('.show_msg').css("width", "100%");
                          $('.show_msg').html(message);
                      }
                  }
              });
          });
      });






































}); //end document ready








