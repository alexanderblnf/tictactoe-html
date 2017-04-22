$('#register-btn').on('click', function () {
   var email = $('#email-register').val();
   var password = $('#password-register').val();
   var firstname = $('#firstName-register').val();
   var lastname = $('#lastName-register').val();

   if(email && password && firstname && lastname) {
       var data = {
           email: email,
           password: password,
           firstname: firstname,
           lastname: lastname
       };
       var request = $.ajax({
           url: 'register.php',
           type: 'post',
           data: data
       });

       request.done(function (response) {
          console.log(response);
       });

       request.fail(function (jqXHR, textStatus, errorThrown) {
           console.log(textStatus + ' ' + errorThrown);
       });
   }
});