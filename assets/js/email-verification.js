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
					console.log('ERR', res);
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
});

