'use_strict';

$(function() {
  let ctrl = true,
    form = $('#verification_form').serialize();
  (input0 = $('[name="email"]').val()),
  (input1 = $('[name="exp"]').val()),
  (input2 = $('[name="sig"]').val()),
  (regex = /^\s*$/);

  switch (false) {
    case !input0.match(regex):
    case !input1.match(regex):
    case !input2.match(regex):
      break;

    default:
      $.post('./assets/hndlr/EmailVerification.php', form, function(res) {
        switch (res) {
          case 'clear':
            /* $('.login-header').prepend(`
            <div class="alert alert-warning fade show" role="alert">
            <strong>Oops!</strong>
            Your account does not exist.
            &nbsp;<a href="./create-profile.php" class="text-primary"><u>Create an account</u></a>
            </div>
            `); */
            break;
          case 'expired!':
            $('.alert-msg').html(`
            <div class="alert alert-danger fade show" role="alert">
            <strong>Oops!</strong>
            Email verification link has expired.
            </div>
            `);
            $('#EVFailedModal').modal('show');
            break;
          case 'verified!':
            $('.login-header').prepend(`
            <div class="alert alert-success fade show" role="alert">
            <strong>Awesome!</strong>
            Your email address was successfully verified! Login to access your account.
            </div>
            `);
            break;
          default:
            $('.alert-msg').html(`
            <div class="alert alert-danger fade show" role="alert">
            <strong>Oops!</strong>
            Email verification failed.
            </div>
            `);
            $('#EVFailedModal').modal('show');
            break;
        }
      });
      break;
  }

  $('.login-header').on('click', '.evfailed', function(e) {
    e.preventDefault();
    $('#EVFailedModal').modal('show');
  });

  $('#evf_form').submit(function(e) {
    e.preventDefault();

    let form = $(this).serialize();

    switch (false) {
      case EVFEmail('evf_form', 'evf_email'):
        // validate email input
        break;

      default:
        WaitModal();
        $.post('./assets/hndlr/EmailVerification.php', form, function(res) {
          switch (res) {
            case 'sent':
              setTimeout(() => {
                SuccessModal(
                  'A verification link has been sent to your email account.',
                  'index.php',
                  0,
                  10000
                );
              }, 5000);
              break;

            default:
              setTimeout(() => {
                ErrorModal(0, 'index.php', 5000);
              }, 5000);
              console.log(res);
              break;
          }
        });
        break;
    }
  });
});

function EVFEmail(form_id, name) {
  let ctrl = true,
    formid = `form#${form_id} `,
    name_attr = formid + `[name="${name}"]`,
    input = $(name_attr).val(),
    regex = new RegExp(
      /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/gi
    ),
    required = !input.match(/^\s*$/) ? true : false,
    validation = '';

  switch (false) {
    case required:
      $(name_attr).addClass('is-invalid');
      $(formid + 'small.' + name)
        .removeClass('text-success')
        .addClass('text-danger')
        .html('Field required.');
      ctrl = false;
      break;
    case regex.test(input):
      $(name_attr).addClass('is-invalid');
      $(formid + 'small.' + name)
        .removeClass('text-success')
        .addClass('text-danger')
        .html('Not a valid email address.');
      ctrl = false;
      break;

    default:
      $(name_attr).removeClass('is-invalid').addClass('is-valid');
      $(formid + 'small.' + name).html('');
      break;
  }

  return ctrl;
}