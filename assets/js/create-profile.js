

$(function () {
   $('#newprofile_form').submit(function (e) {
      e.preventDefault();

      $([document.documentElement, document.body]).animate({
         scrollTop: $('.main-card').offset().top
      }, 500);

      let form = $(this).serialize(),
         regex = /\b(\w*CTE\w*)\b/g;

      switch (false) {
         case ValidateRequired('newprofile_form', 'create_given'):
         case ValidateRequired('newprofile_form', 'create_surname'):
         case ValidateUsername('newprofile_form', 'create_username'):
         case ValidateEmail('newprofile_form', 'create_email'):
         case ValidatePassword('newprofile_form', 'create_password'):
         case PasswordMatch(
            'newprofile_form',
            'create_password',
            'create_password2'
         ):
            break;

         default:
            WaitModal();
            // SuccessModal('Your account has been created.', 'login.php', 5000);
            $.ajax({
               type: 'POST',
               url: './assets/hndlr/CreateProfile.php',
               data: form,
               success: function (res) {
                  if (res.match(regex)) {
                     let unverified = res;

                     $.post('./assets/hndlr/CreateProfile.php', {
                        unverified
                     }, function (response) {
                        console.log(response)
                        switch (response) {
                           case 'sent':
                              setTimeout(() => {
                                 SuccessModal('A verification link has been sent to your email account.', 'index.php', 0, 10000);
                              }, 5000);
                              break;

                           default:
                              setTimeout(() => {
                                 ErrorModal(0, 0, 5000);
                              }, 5000);
                              console.log('ERR', response);
                              break;
                        }
                     });
                  } else {
                     ErrorModal(0, 0, 5000);
                     console.log('ERR', res);
                  }
               }
            });
            break;
      }
   });
});

function PasswordMatch(form_id, name1, name2) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr1 = formid + `[name="${name1}"]`,
      name_attr2 = formid + `[name="${name2}"]`,
      input1 = $(name_attr1).val(),
      input2 = $(name_attr2).val(),
      match = input2.match(input1) ? true : false;

   switch (false) {
      case match:
         $(name_attr1)
            .removeClass('is-valid')
            .addClass('is-invalid');
         $(formid + 'small.' + name1)
            .removeClass('text-success')
            .addClass('text-danger')
            .html("Passwords don't match.");
         $(name_attr2)
            .removeClass('is-valid')
            .addClass('is-invalid');
         ctrl = false;
         break;

      default:
         $(name_attr1)
            .removeClass('is-invalid')
            .addClass('is-valid');
         $(formid + 'small.' + name1)
            .removeClass('text-danger')
            .addClass('text-success')
            .html('');
         $(name_attr2)
            .removeClass('is-invalid')
            .addClass('is-valid');
         break;
   }

   return ctrl;
}