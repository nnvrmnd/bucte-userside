

$(function () {
   /* replace all anchortag with # -> javascript:void(0) */
   let anchortag = $('body').find('a');
   anchortag.each(function () {
      if ($(this).attr('href') == '#') {
         $(this).attr('href', 'javascript:void(0)');
      }
   });

   /* Ordered list style */
   let olist = $('.ckfetch').find('ol'),
      olist_style = olist.attr('style'),
      blockqt = $('.ckfetch').find('blockquote');

   olist.find('li').attr('style', olist_style);

   /* Blockquotes */
   blockqt
      .css({
         'margin-left': '3%',
         'font-style': 'italic'
      })
      .find('p')
      .prepend('"')
      .append('"')
      .css('font-weight', 'bold');
});

$(function () {
   $('.modal').on('hidden.bs.modal', function () {
      $(this)
         .find('form')
         .trigger('reset');
      $(this)
         .find('.form-control')
         .removeClass('is-invalid');
      $('.msg').html('');
   });

   /* Show logged in/out */
   let user_rn = $('#user_rn').val();
   DisplayUserRN('topnav');
   if (user_rn.length > 0) {
      $('#login_li')
         .find('ul.dropdown')
         .removeClass('d-none');
   } else {
      $('#login').html('Login');
      $('#login_li')
         .find('ul.dropdown')
         .addClass('d-none');
      $('#login').click(function (e) {
         e.preventDefault();
         $('#LoginModal').modal('show');
      });
   }

   /* Logout */
   $('#logout').click(function (e) {
      e.preventDefault();
      $.post(
         './assets/hndlr/Login.php', {
            logout: 'true'
         },
         function (res) {
            location.reload();
         }
      );
   });

   /* Login */
   $('form#login_form, form#loginpage_form').submit(function (e) {
      e.preventDefault();

      let thisform = $(this),
         cred = $(this).serialize();

      $.ajax({
         type: 'POST',
         url: './assets/hndlr/Login.php',
         data: cred,
         success: function (res) {
            console.log(res)
            switch (res) {
               case 'unverified':
                  $('.login-msg').html('This account is not yet verified. Please check your email.');
                  thisform.find('input.form-control').addClass('is-invalid');
                  break;

               case 'true':
                  $('.login-msg').html('');
                  thisform.find('.form-control').removeClass('is-invalid');
                  window.location.reload();
                  break;

               default:
                  $('.login-msg').html('Incorrect username/email or password.');
                  thisform.find('input.form-control').addClass('is-invalid');

                  console.log('ERR', res);
                  break;
            }
         },
         error: function () {
            console.log('err:handling');
         }
      });
   });
});

var timer = null; // for timeouts

function WaitModal() {
   window.clearTimeout(timer);
   $('.modal').modal('hide');
   $('#WaitModal').modal('show');

   /* timer = setTimeout(() => {
      $('#WaitModal').modal('hide');
      timer = null;
   }, timeout - 1000); */
}

function SuccessModal(msg, redirect, newtab, timeout) {
   if (redirect !== 0) {
      $('#SuccessModal').on('hidden.bs.modal', function () {
         if (newtab === 1) {
            window.open(redirect, '_blank');
         } else{
            window.location.href = redirect;
         }
      });
   }

   window.clearTimeout(timer);
   $('#success-modal-msg').html(msg);
   $('.modal').modal('hide');
   $('#SuccessModal').modal('show');

   timer = setTimeout(() => {
      $('#success-modal-msg').html('');
      $('#SuccessModal').modal('hide');
      timer = null;
   }, timeout - 1000);
}

function ErrorModal(msg, redirect, timeout) {
   let message = msg === 0 ? 'Something went wrong.' : msg;

   if (redirect !== 0) {
      $('#SuccessModal').on('hidden.bs.modal', function () {
         window.location.href = redirect;
      });
   }

   window.clearTimeout(timer);
   $('#error-modal-msg').html(message);
   $('.modal').modal('hide');
   $('#ErrorModal').modal('show');

   timer = setTimeout(() => {
      $('#error-modal-msg').html('');
      $('#ErrorModal').modal('hide');
      timer = null;
   }, timeout - 1000);
}

function PromptModal(msg, redirect, timeout, action, id1, id2) {
   $('#yes_prompt')
      .attr('data-action', action)
      .attr('data-target-1', id1)
      .attr('data-target-2', id2);

   if (redirect !== 0) {
      $('#PromptModal').on('hidden.bs.modal', function () {
         window.location.href = redirect;
      });
   }

   window.clearTimeout(timer);
   $('#prompt-modal-msg').html(msg);
   /* $('.modal').modal('hide'); */
   $('#PromptModal').modal('show');

   timer = setTimeout(() => {
      $('#prompt-modal-msg').html('');
      $('#PromptModal').modal('hide');
      timer = null;
   }, timeout - 1000);
}

function DisplayUserRN(location) {
   let user_rn = $('#user_rn').val(),
      regex = /^\s*$/;
   if (!user_rn.match(regex)) {
      $.post(
         './assets/hndlr/Global.php', {
            userrn: user_rn
         },
         function (res) {
            let el = JSON.parse(res);
            $('#login').html(`<b class="text-uppercase">${el.given}</b>`);
         }
      );
   }
}

function IDUserRN(input) {
   let user_rn = $('#user_rn').val();
   $.post(
      './assets/hndlr/Global.php', {
         iduserrn: user_rn
      },
      function (res) {
         if (res != 'err:fetch') {
            $(input).val(res);
         } else {
            console.log('ERR', res);
         }
      }
   );
}

function unicode(name) {
   let this_name = $(`[name="${name}"]`).val();

   this_name
      .replace(/\!/g, '&#33;')
      .replace(/"/g, '&#34;')
      .replace(/\#/g, '&#35;')
      .replace(/\$/g, '&#36;')
      .replace(/\%/g, '&#37;')
      .replace(/&/g, '&#38;')
      .replace(/'/g, '&#39;')
      .replace(/\(/g, '&#40;')
      .replace(/\)/g, '&#41;')
      .replace(/\*/g, '&#42;')
      .replace(/\+/g, '&#43;')
      .replace(/,/g, '&#44;')
      .replace(/-/g, '&#45;')
      .replace(/./g, '&#46;')
      .replace(/\//g, '&#47;')
      .replace(/:/g, '&#58;')
      .replace(/;/g, '&#59;')
      .replace(/\</g, '&#60;')
      .replace(/\=/g, '&#61;')
      .replace(/\>/g, '&#62;')
      .replace(/\?/g, '&#63;')
      .replace(/\@/g, '&#64;')
      .replace(/\[/g, '&#91;')
      .replace(/\\/g, '&#92;')
      .replace(/\]/g, '&#93;')
      .replace(/\^/g, '&#94;')
      .replace(/_/g, '&#95;')
      .replace(/`/g, '&#96;')
      .replace(/\{/g, '&#123;')
      .replace(/|/g, '&#124;')
      .replace(/\}/g, '&#125;')
      .replace(/~/g, '&#126;');

}

/* Validate required input */
function ValidateRequired(form_id, name) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr = formid + `[name="${name}"]`,
      input = $(name_attr).val(),
      regex = /^\s*$/,
      required = !input.match(regex) ? true : false;

   switch (false) {
      case required:
         $(name_attr).addClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .addClass('text-danger')
            .html('Field required.');
         ctrl = false;
         break;

      default:
         unicode(name);
         $(name_attr).removeClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .html('');
         break;
   }

   return ctrl;
}

/* Validate username input */
function ValidateUsername(form_id, name) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr = formid + `[name="${name}"]`,
      input = $(name_attr).val(),
      regex = new RegExp(/^[a-z0-9_]{5,16}$/gi),
      length = input.length >= 5 ? true : false,
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
      case length:
         $(name_attr).addClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .addClass('text-danger')
            .html('Use at least 5 or more characters.');
         ctrl = false;
         break;
      case regex.test(input):
         $(name_attr).addClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .addClass('text-danger')
            .html('You can use letters, numbers & underscores.');
         ctrl = false;
         break;

      default:
         $.ajax({
            type: 'POST',
            url: './assets/hndlr/CreateProfile.php',
            data: {
               validate_username: input
            },
            async: false,
            success: function (res) {
               switch (res) {
                  case 'not available':
                     $(name_attr)
                        .removeClass('is-valid')
                        .addClass('is-invalid');
                     $(formid + 'small.' + name)
                        .removeClass('text-success')
                        .addClass('text-danger')
                        .html('Username not available.');
                     ctrl = false;
                     break;
                  case 'available':
                     $(name_attr)
                        .removeClass('is-invalid')
                        .addClass('is-valid');
                     $(formid + 'small.' + name).html('');
                     break;
                  default:
                     console.log('ValidateUsername', res);
                     ErrorModal(0, 0, 5000);
                     ctrl = false;
                     break;
               }
            }
         });
         break;
   }

   return ctrl;
}

/* Validate email input */
function ValidateEmail(form_id, name) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr = formid + `[name="${name}"]`,
      input = $(name_attr).val(),
      regex = new RegExp(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/gi),
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
         $.ajax({
            type: 'POST',
            url: './assets/hndlr/CreateProfile.php',
            data: {
               validate_email: input
            },
            async: false,
            success: function (res) {
               switch (res) {
                  case 'not available':
                     $(name_attr)
                        .removeClass('is-valid')
                        .addClass('is-invalid');
                     $(formid + 'small.' + name)
                        .removeClass('text-success')
                        .addClass('text-danger')
                        .html('Email already registered.');
                     ctrl = false;
                     break;
                  case 'available':
                     $(name_attr)
                        .removeClass('is-invalid')
                        .addClass('is-valid');
                     $(formid + 'small.' + name).html('');
                     break;
                  default:
                     console.log('ValidateEmail', res);
                     ErrorModal(0, 0, 5000);
                     ctrl = false;
                     break;
               }
            }
         });
         break;
   }

   return ctrl;
}

/* Validate password input */
function ValidatePassword(form_id, name) {
   let ctrl = true,
      formid = `form#${form_id} `,
      name_attr = formid + `[name="${name}"]`,
      input = $(name_attr).val(),
      length = input.length >= 8 ? true : false,
      regex = /^\s*$/,
      required = !input.match(regex) ? true : false;

   switch (false) {
      case required:
         $(name_attr)
            .removeClass('is-valid')
            .addClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .addClass('text-danger')
            .html('Field required.');
         ctrl = false;
         break;
      case length:
         $(name_attr)
            .removeClass('is-valid')
            .addClass('is-invalid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .addClass('text-danger')
            .html('Enter a combination of at least 8 characters.');
         ctrl = false;
         break;

      default:
         $(name_attr)
            .removeClass('is-invalid')
            .addClass('is-valid');
         $(formid + 'small.' + name)
            .removeClass('text-success')
            .html('');
         break;
   }

   return ctrl;
}