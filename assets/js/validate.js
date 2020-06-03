$.validator.methods.email = function( value, element ) {
    return this.optional( element ) || /[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]+/.test( value );
  }

$(function() {
    $("#orderInfoForm").validate({
      rules: {
        name: "required",
        contactNo: {
            required: true,
            digits: true,
            minlength: 11,
            maxlength: 11
          },
        email: {
          required: true,
          email: true
        },
        address: "required",
        area: "required",
        city: "required",
        state: "required",
        country: "required"
      },
      messages: {
        name: "Please enter your name.",
        contactNo: {
            required: "Please provide your contact number.",
            digits: "Please enter a valid contact number.",
            minlength: jQuery.validator.format("{0} characters required!"),
            maxlength: jQuery.validator.format("{0} characters required!")
          },
        email: {
          required: "Please provide an email.",
          email: "Please enter a valid email address."
        },
        address: "Please provide your address.",
        area: "Please select your Area.",
        city: "Please select your City.",
        state: "Please select your State.",
        country:"Please select your Country.",

      },
      submitHandler: function(form) {
        form.submit();
      }
      
    });

    $("#contactus").validate({
      errorClass: "text-danger",
      rules: {
        name: "required",
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11
        },
        message: "required",
      },
      messages: {
        name: "Please enter your name.",
        email: {
          required: "Please provide an email.",
          email: "Please enter a valid email address."
        },
        phone: {
          required: "Please provide your contact number.",
          digits: "Please enter a valid contact number.",
          minlength: jQuery.validator.format("{0} characters required!"),
          maxlength: jQuery.validator.format("{0} characters required!")
        },
        message: "Please write the message."
      },
      submitHandler: function(form) 
      {
        form.submit();
      }
    });
  });