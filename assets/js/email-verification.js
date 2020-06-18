$(function () {
  let urlParams = new URLSearchParams(window.location.search),
    email = urlParams.get('e'),
    sig = urlParams.get('s');

  if (email != null && sig != null) {
    $.post('./assets/hndlr/EmailVerification.php', { email, sig }, function (
      res
    ) {
      switch (res) {
        case '!registered':
          $('.login-header').prepend(`
						<div class="alert alert-warning fade show" role="alert">
						<strong>Oops!</strong>
						Your account does not exist.
						&nbsp;<a href="./create-profile.php" class="text-primary"><u>Create an account</u></a>
						</div>
						`);
          break;
        case '!signature':
          $('.alert-msg').html(`
            <div class="alert alert-danger fade show" role="alert">
            <strong>Oops!</strong>
            Email verification failed.
            </div>
						`);
          $('#EVFailedModal').modal('show');
          break;
        case 'expired':
          $('.alert-msg').html(`
						<div class="alert alert-danger fade show" role="alert">
						<strong>Oops!</strong>
						Email verification link has expired.
						</div>
						`);
          $('#EVFailedModal').modal('show');
          break;
        case 'true':
          $('.login-header').prepend(`
						<div class="alert alert-success fade show" role="alert">
						<strong>Awesome!</strong>
						Your email address was successfully verified! Login to access your account.
						</div>
						`);
          break;

        default:
          console.error('ERR', res);
          $('.login-header').prepend(`
						<div class="alert alert-danger fade show" role="alert">
						<strong>Oops!</strong>
						Something went wrong!
						</div>
						`);
          break;
      }
    });
  }

  $('#rev_form').submit(function (e) {
    e.preventDefault();

    let formid = $(this).attr('id');

    function RegisteredEmail(formId, nameProp) {
      let $element = $(`#${formId} [name=${nameProp}]`),
        $msg = $(`small.${nameProp}`),
        input = $element.val(),
        required = input.match(/^\s*$/) ? true : false,
        urlParams = new URLSearchParams(window.location.search),
        email = urlParams.get('e'),
        regex = new RegExp(`\\b${email}\\b`);

      return new Promise((resolve, reject) => {
        switch (true) {
          case required:
            $element.addClass('is-invalid');
            $msg
              .removeClass('text-success')
              .addClass('text-danger')
              .html('Field required.');
            resolve('false');
            break;
          case !input.match(regex):
            $element.addClass('is-invalid');
            $msg
              .removeClass('text-success')
              .addClass('text-danger')
              .html('Incorrect email address.');
            resolve('false');
            break;

          default:
            $element.removeClass('is-invalid');
            $msg.removeClass('text-danger').empty();
            resolve(input);
            break;
        }
      });
    }

    function Submit(unverified) {
      return new Promise((resolve, reject) => {
        WaitModal(10000);

        $.ajax({
          type: 'POST',
          url: './assets/hndlr/EmailVerification.php',
          data: { unverified },
          success: function (res) {
            if (res == 'sent') {
              resolve(res);
              SuccessModal(
                'An email-verification link has been sent to your email.',
                10000
              );
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

    async function Process() {
      try {
        const regRes = await RegisteredEmail(formid, 'rev_email');
        if (regRes == 'false') {
          return;
        }
        const submitRes = Submit(regRes);
      } catch (e) {
        console.error(`${e.where}\n${e.message}`);
        ErrorModal(5000);
      }
    }

    Process();
  });

  /* Validate email */
  /* function CheckEmail(formId, nameProp) {
    return new Promise((resolve, reject) => {
      let ctrl = true,
        $element = $(`#${formId} [name=${nameProp}]`),
        $msg = $(`small.${nameProp}`),
        input = $element.val(),
        required = !input.match(/^\s*$/) ? true : false,
        regex = new RegExp(
          /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/gi
        );

      function EmailAvailability(input) {
        $.ajax({
          type: 'POST',
          url: './assets/hndlr/EmailVerification.php',
          data: { email: input },
          success: function (res) {
            if (res == 'true') {
              resolve('true'); // available
              $element.removeClass('is-invalid');
              $msg.removeClass('text-danger').addClass('text-success').empty();
              setTimeout(() => {
                $msg.empty();
              }, 2000);
            } else if (res == 'false') {
              resolve('false');
              $element.addClass('is-invalid');
              $msg
                .removeClass('text-success')
                .addClass('text-danger')
                .html('Incorrect email address.');
            } else {
              reject({
                where: 'EmailAvailability',
                message: res,
              });
            }
          },
        });
      }

      switch (false) {
        case required:
          $element.addClass('is-invalid');
          $msg
            .removeClass('text-success')
            .addClass('text-danger')
            .html('Field required.');
          resolve('false');
          break;
        case regex.test(input):
          $element.addClass('is-invalid');
          $msg
            .removeClass('text-success')
            .addClass('text-danger')
            .html('Not a valid email address.');
          resolve('false');
          break;

        default:
          EmailAvailability(input);
          break;
      }
    });
  } */
});
