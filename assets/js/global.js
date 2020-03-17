'use_strict';

$(function () {
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
   $('form#login_form').submit(function (e) {
      e.preventDefault();

      let thisform = $(this),
         cred = $(this).serialize();

      $.ajax({
         type: 'POST',
         url: './assets/hndlr/Login.php',
         data: cred,
         success: function (res) {
            switch (res) {
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

function SuccessModal(msg, redirect, timeout) {
   if (redirect !== 0) {
      $('#SuccessModal').on('hidden.bs.modal', function () {
         window.location.href = redirect;
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