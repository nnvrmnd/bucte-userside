$(function () {
  $('#create_form').submit(function (e) {
    e.preventDefault();

    let form = $(this).serializeArray(),
      formid = $(this).attr('id');

    function Submit(createForm) {
      return new Promise((resolve, reject) => {
        WaitModal(10000);

        $.ajax({
          type: 'POST',
          url: './assets/hndlr/CreateProfile.php',
          data: createForm,
          success: function (res) {
            if (res.match(/\b(\w*CTE\w*)\b/g)) {
              resolve(res);
              // SuccessModal('Account created.', 5000);
            } else {
              reject({
                where: 'Submit',
                message: res,
              });
            }
          },
        });
      });
    }

    function Unverified(id) {
      return new Promise((resolve, reject) => {
        $.ajax({
          type: 'POST',
          url: './assets/hndlr/CreateProfile.php',
          data: { unverified: id },
          success: function (res) {
						console.log(res)
            if (res == 'sent') {
              resolve(res);
							SuccessModal('Account created.', 5000);
							$('#SuccessModal').on('hidden.bs.modal', function () {
								window.location.href = '/app/';
							});
            } else {
              reject({
                where: 'Unverified',
                message: res,
              });
            }
          },
        });
      });
    }

    async function Process(
      formId,
      usernameProp,
      emailProp,
      passProp,
      repassProp,
      createForm
    ) {
      try {
        const usernameRes = await ValidateUsername(formId, usernameProp);
        if (usernameRes == 'false') {
          ScrollUp('.main-card');
          return;
        }
        const emailRes = await ValidateEmail(formId, emailProp);
        if (emailRes == 'false') {
          ScrollUp('.main-card');
          return;
        }
        const passwordRes = await ValidatePassword(
          formId,
          passProp,
          repassProp
        );
        if (passwordRes == 'false') {
          return;
        }
				const submitRes = await Submit(createForm);
				const unverifiedRes = await Unverified(submitRes);

      } catch (e) {
        console.error(`${e.where}\n${e.message}`);
        ErrorModal(5000);
      }
    }

    switch (false) {
      case ValidateRequired(formid, 'create_given'):
      case ValidateRequired(formid, 'create_surname'):
        ScrollUp('.main-card');
        break;

      default:
        Process(
          formid,
          'create_username',
          'create_email',
          'create_password',
          'create_password2',
          form
        );
        break;
    }
  });
});

function ValidatePassword(formId, nameProp1, nameProp2) {
  return new Promise((resolve, reject) => {
    let ctrl = true,
      $element1 = $(`#${formId} [name=${nameProp1}]`),
      $element2 = $(`#${formId} [name=${nameProp2}]`),
      input1 = $element1.val(),
      input2 = $element2.val(),
      $msg1 = $(`small.${nameProp1}`),
			$msg2 = $(`small.${nameProp2}`),
      regex = new RegExp(`\\b${input1}\\b`);

    switch (true) {
      case input1.length <= 4:
        $element1.addClass('is-invalid');
        $msg1
          .removeClass('text-success')
          .addClass('text-danger')
          .html('Enter a combination of at least 5 characters.');
        resolve('false');
        break;
      case !input2.match(regex):
        $element1.addClass('is-invalid');
        $element2.addClass('is-invalid');
        $msg1.addClass('text-danger');
        $msg2.addClass('text-danger').html('Passwords do not match.');
        resolve('false');
        break;

      default:
        $element1.removeClass('is-invalid');
        $element2.removeClass('is-invalid');
        $msg1.empty();
        $msg2.empty();
				resolve('true');
        break;
    }
  });
}
