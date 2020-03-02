'use_strict';

/* Commons */
let lvl_sesh = sessionStorage.getItem('lvl'),
  rvwr_sesh = sessionStorage.getItem('rvwr'),
  duration = '',
  current_testee = "";

/* Triggers */
$(function () {

  /* Change page title */
  if (rvwr_sesh != null && rvwr_sesh != 'undefined') {
    $('[name="reviewer"]').val(rvwr_sesh);
  } else {
    window.location.href = 'reviewer.php';
  }

  /* Load reviewer list */
  IDUserRN('[name="testee"]');
  setTimeout(() => {
    current_testee = $('[name="testee"]').val();
    $.post('./assets/hndlr/Result.php', {
      iftaken: rvwr_sesh,
      testee: current_testee
    }, function (res) {
      if (res == 'taken') {
        RenderList(rvwr_sesh, current_testee);
        Scores(rvwr_sesh, current_testee)
      } else if (res == '!taken') {
        window.location.href = 'reviewer.php';
      }
    });
  }, 1000);

  /* Retake test */
  $('#retake_btn').click(function (e) {
    e.preventDefault();

    PromptModal(
      'Retaking test? Your score here will be deleted.',
      0,
      5000,
      'retake_test',
      rvwr_sesh,
      current_testee
    );
  });

  $('#yes_prompt').click(function (e) {
    e.preventDefault();
    let retake = $(this).attr('data-target-1'),
      testee = $(this).attr('data-target-2');

    $.post("./assets/hndlr/Result.php", { retake, testee },
      function (res) {
        if (res == "true") {
          SuccessModal('Loading questionnaire.', 'questionnaire.php', 5000);
        } else {
          console.log('ERR', res)
        }

      }
    );
  });
});
/* Triggers */

/* Functions ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/* Fetch questionnaire items */
function RenderList(selected_reviewer, testee) {
  $.post(
    './assets/hndlr/Result.php', {
      selected_reviewer,
      testee
    },
    function (res) {

      if (res != 'err:fetch') {
        $.each(JSON.parse(res), function (idx, el) {
          if (!res.match(/\b(\w*err\w*)\b/g)) {
            let regex = /^\s*$/,
              optC = el.optionC,
              optD = el.optionD,
              optionC = '',
              optionD = '';

            switch (true) {
              case !optD.match(regex) && !optD.match(regex):
                optionC = `<label data-target="${el.question_id}" data-value="c">
                    <input type="radio" class="radio-inline choices" name="${el.question_id}" value="c" disabled>
                    <span class="outside none">
                        <span class="inside none"></span>
                    </span>C. &nbsp; ${el.optionC}
                </label>`;
                optionD = `<label data-target="${el.question_id}" data-value="d">
                    <input type="radio" class="radio-inline choices" name="${el.question_id}" value="d" disabled>
                    <span class="outside none">
                        <span class="inside none"></span>
                    </span>D. &nbsp; ${el.optionD}
                </label>`;
                break;
              case !optC.match(regex):
                optionC = `<label data-target="${el.question_id}" data-value="c">
                    <input type="radio" class="radio-inline choices" name="${el.question_id}" value="c" disabled>
                    <span class="outside none">
                        <span class="inside none"></span>
                    </span>C. &nbsp; ${el.optionC}
                </label>`;
                break;
            }

            $('.items-container').append(`
              <div class="row align-items-center box-shadow mx-5 mb-4">
                <div class="m-3" data-wow-delay="500ms">
                <h5 class="font-weight-bold">${idx + 1}.&ensp;${
              el.question
            }</h5>
                <label data-target="${el.question_id}" data-value="a">
                <input type="radio" class="radio-inline choices" name="${
                  el.question_id
                }" value="a" disabled>
                <span class="outside none">
                    <span class="inside none"></span>
                </span>A. &nbsp; ${el.optionA}
                </label>
                <label data-target="${el.question_id}" data-value="b">
                    <input type="radio" class="radio-inline choices" name="${
                      el.question_id
                    }" value="b" disabled>
                    <span class="outside none">
                        <span class="inside none"></span>
                    </span>B. &nbsp; ${el.optionB}
                </label>
                ${optionC}
                ${optionD}
                </div>
              </div>
            `);

            /* Select user's answer */
            $(
                `label[data-target="${el.question_id}"][data-value="${el.chosen}"]`
              )
              .find('input')
              .prop('checked', true);

            /* Highlight correct answer */
            $(
                `label[data-target="${el.question_id}"][data-value="${el.correct}"]`
              )
              .find('span')
              .removeClass('none')
              .addClass('answered-correct');

            /* Check if user's answer is wrong */
            if ($(`input[value="${el.chosen}"]:checked`).val() != el.correct) {
              $(
                  `label[data-target="${el.question_id}"][data-value="${el.chosen}"]`
                )
                .find('span')
                .removeClass('none')
                .addClass('answered-wrong');
            }
          } else {
            console.log('err:res');
          }
        });
      } else {
        console.log('ERR', 'err:fetch');
      }
    }
  );
}

/* Scores */
function Scores(result, testee) {
  $.post('./assets/hndlr/Result.php', {
    result,
    testee
  }, function (res) {
    if (res != 'err:fetch') {
      $.each(JSON.parse(res), function (idx, el) {
        if (!res.match(/\b(\w*err\w*)\b/g)) {

          $('#noitems').html(el.noitems);
          $('#ansd').html(el.answered);
          $('#unansd').html(el.unanswered);
          $('#score').html(el.score);

          if (el.score >= ((el.noitems * 0.76) | 0)) {
            $('#score').addClass('text-success');
          } else {
            $('#score').addClass('text-danger');
          }
        }
      });
    }
  });
}