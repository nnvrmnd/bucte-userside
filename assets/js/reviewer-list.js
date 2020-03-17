'use_strict';

/* Commons */
let lvl_sesh = sessionStorage.getItem('lvl'),
   rvwr_sesh = sessionStorage.getItem('rvwr');

/* CSS */
$(function () {});

/* Triggers */
$(function () {
   /* Change page title */
   if (lvl_sesh != null && lvl_sesh != 'undefined') {
      let level = '';
      switch (lvl_sesh) {
         case 'gen':
            level = 'General';
            break;
         case 'prof':
            level = 'Professional';
            break;
         case 'eng':
            level = 'English';
            break;
         case 'fil':
            level = 'Filipino';
            break;
         case 'bio':
            level = 'Biology Sciences';
            break;
         case 'phys':
            level = 'Physical Sciences';
            break;
         case 'math':
            level = 'Mathematics';
            break;
         case 'socsci':
            level = 'Social Studies/Sciences';
            break;
         case 'values':
            level = 'Values';
            break;
         case 'mapeh':
            level = 'MAPEH';
            break;
         case 'agri':
            level = 'Agriculture and Fishery Arts';
            break;
         case 'tech':
            level = 'Technology and Livelihood';
            break;
      }
      $('.list-title').html(level + ' Education');
   } else {
      window.location.href = 'reviewer.php';
   }

   /* Select reviewer */
   $('.reviewers-container').on('click', '.reviewer', function (e) {
      e.preventDefault();

      let selected = $(this).attr('data-target'),
         user_rn = $('#user_rn').val();

      if (user_rn.length <= 0) {
         $('#login').click();
      } else {
         sessionStorage.setItem('rvwr', selected);
         window.location.href = 'questionnaire.php';
      }
   });

   /* Load reviewer list */
   RenderList(lvl_sesh);
});
/* Triggers */

/* Functions ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/* Fetch reviewers' list */
function RenderList(selected_level) {
   $.post(
      './assets/hndlr/Reviewer.php', {
         selected_level
      },
      function (res) {
         $('.reviewers-container').html('');

         if (res != 'err:fetch') {
            $.each(JSON.parse(res), function (idx, el) {
               if (!res.match(/\b(\w*err\w*)\b/g)) {
                  let regex = /^\s*$/,
                     description = el.description;

                  if (!description.match(regex) === false) {
                     description = '<i>No description...</i>';
                  }

                  $('.reviewers-container').append(`
                  <div class="single-recent-post d-flex pointer-here reviewer" data-target="${el.reviewer_id}">
                     <div class="post-thumb">
                        <a href="javascript:void(0)"><img src="./dist/img/bg-img/29.jpg" alt=""></a>
                     </div>
                     <div class="post-content">
                        <a href="javascript:void(0)" class="font-weight-bold post-title mb-2" style="font-size:18px">
                           ${el.title}
                        </a>
                        <p class="mb-0">${description}</p>
                        <p>&mdash; ${el.source}</p>
                     </div>
                  </div>
                  `);
               } else {
                  console.log('err:res');
               }
            });
         } else {
            $('#instruction').html('');
            $('.reviewers-container').append(`
            <div class="section reviewer">
               <h1>This page is under construction...</h1>
               <p></p>
            </div>
         `);
            console.log('ERR', 'err:fetch');
         }
      }
   );
}