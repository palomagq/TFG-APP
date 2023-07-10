function msgError(msg){

    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: msg,
        showConfirmButton: false,
        timer: 2500
    });
}

function msgSuccess(msg){
    
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 2500
    });
}



// Wait for the DOM to be ready

//createUser
$(function() {

    // Initialize form validation on the registration form.
  
    // It has the name attribute "registration"
  
    $("form[name='createUser']").validate({
  
      // Specify validation rules
  
      rules: {
  
        // The key name on the left side is the name attribute
  
        // of an input field. Validation rules are defined
  
        // on the right side
  
        nombre: "required",
  
        apellidos: "required",
  
        email: {
  
          required: true,

          email: true
  
        },
        dni:"required",
        sexo:"required",
        telefono:{
            required: true, 
            pattern: "/^\d{9}$/",
            },
        fechaNac:"required",
        usersname:"required",
        password: {
                    required: true, 
                    minlength: 5,
                    }
  
      },
  
      // Specify validation error messages
  
      messages: {
  
        nombre: "Por favor, introduzca su nombre", 
        apellidos: "Por favor, introduzca sus apellidos",
        dni:"Por favor, introduzca su DNI",
        sexo:"Por favor, seleccione su sexo",
        telefono:
        {
  
            required: "Por favor, introduzca su teléfono",
            minlength: "Su teléfono debe tener 9 dígitos."
    
          },
        fechaNac:"Por favor, introduzca su fecha de nacimiento (dd/mm/AAAA)",
        email: "Por favor, introduce una dirección de correo electrónico válida",
        usersname:"Por favor, introduzca su usersname",
        password: {
  
            required: "Por favor proporcione una contraseña",
            minlength: "Su contraseña debe tener al menos 5 caracteres."
    
          }

      },
  
      submitHandler: function(form) {
        
        console.log("Hola")
        form.submit();
  
      }
  
    });
  
  });



  //createGimnasio
  $(function() {

    // Initialize form validation on the registration form.
  
    // It has the name attribute "registration"
  
    $("form[name='createGimnasio']").validate({
  
      // Specify validation rules
  
      rules: {
  
        // The key name on the left side is the name attribute
  
        // of an input field. Validation rules are defined
  
        // on the right side
  
        nombre: "required",
        direccion: "required",
        localidad:"required",
        provincia:"required",
        codigo_postal:"required"
  
      },
  
      // Specify validation error messages
  
      messages: {
  
        nombre: "Por favor, introduzca su nombre", 
        direccion: "Por favor, introduzca su dirección",
        localidad:"Por favor, introduzca su localidad",
        provincia:"Por favor, seleccione su provincia",
        codigo_postal:"Por favor, introduzca su código postal"

      },
  
      submitHandler: function(form) {
  
        form.submit();
  
      }
  
    });
  
  });



//createSalas
  $(function() {

    // Initialize form validation on the registration form.
  
    // It has the name attribute "registration"
  
    $("form[name='createSala']").validate({
  
      // Specify validation rules
  
      rules: {
  
        // The key name on the left side is the name attribute
  
        // of an input field. Validation rules are defined
  
        // on the right side
  
        nombre: "required",
        capacidad: "required",
  
      },
  
      // Specify validation error messages
  
      messages: {
  
        nombre: "Por favor, introduzca su nombre", 
        capacidad: "Por favor, introduzca su capacidad"

      },
  
      submitHandler: function(form) {
  
        form.submit();
  
      }
  
    });
  
  });


//createClase
  $(function() {

    // Initialize form validation on the registration form.
  
    // It has the name attribute "registration"
  
    $("form[name='createClase']").validate({
  
      // Specify validation rules
  
      rules: {
  
        // The key name on the left side is the name attribute
  
        // of an input field. Validation rules are defined
  
        // on the right side
  
        nombre: "required"  
      },
  
      // Specify validation error messages
  
      messages: {
  
        nombre: "Por favor, introduzca su nombre"
      },
  
      submitHandler: function(form) {
  
        form.submit();
  
      }
  
    });
  
  });






  //login

  
(function ($) {
  "use strict";


   /*==================================================================
  [ Focus input ]*/
  $('.input100').each(function(){
      $(this).on('blur', function(){
          if($(this).val().trim() != "") {
              $(this).addClass('has-val');
          }
          else {
              $(this).removeClass('has-val');
          }
      })    
  })


  /*==================================================================
  [ Validate ]*/
  var input = $('.validate-input .input100');

  $('.validate-form').on('submit',function(){
      var check = true;

      for(var i=0; i<input.length; i++) {
          if(validate(input[i]) == false){
              showValidate(input[i]);
              check=false;
          }
      }

      return check;
  });


  $('.validate-form .input100').each(function(){
      $(this).focus(function(){
         hideValidate(this);
      });
  });

  function validate (input) {
      if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
          if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
              return false;
          }
      }
      else {
          if($(input).val().trim() == ''){
              return false;
          }
      }
  }

  function showValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).addClass('alert-validate');
  }

  function hideValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).removeClass('alert-validate');
  }
  
  

})(jQuery);