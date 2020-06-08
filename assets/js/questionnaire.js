

/* Commons */
let lvl_sesh = sessionStorage.getItem('lvl'),
  rvwr_sesh = sessionStorage.getItem('rvwr'),
  duration = '';

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
    let current_testee = $('[name="testee"]').val();
    $.post('./assets/hndlr/Result.php', {
      iftaken: rvwr_sesh,
      testee: current_testee
    }, function (res) {
      if (res == '!taken') {
        RenderList(rvwr_sesh);
      } else if (res == 'taken') {
        window.location.href = 'result.php';
      }
    });
  }, 1000);

  /* Cue modal message */
  $.post('./assets/hndlr/Questionnaire.php', {
    set_timer: rvwr_sesh
  }, function (res) {
    if (res != 'err:duration') {
      duration = res;

      let tofinish = '';

      switch (res) {
        case '30':
          tofinish = '30 mins';
          break;
        case '45':
          tofinish = '45 mins';
          break;
        case '60':
          tofinish = '1 hour';
          break;
        case '90':
          tofinish = '1 hour and 30 mins';
          break;
        case '120':
          tofinish = '2 hours';
          break;
      }

      $('#Ns').html(tofinish);
    } else {
      console.log('ERR', res);
      $('#Ns').html('N');
    }
  });

  /* Cue modal show */
  $('#CueModal').modal({
    show: true,
    keyboard: false,
    backdrop: 'static'
  });

  /* Begin the test */
  $('#begin_btn').click(function (e) {
    e.preventDefault();

    $('#CueModal')
      .on('shown.bs.modal', function (e) {
        $('div.itms').addClass('sensored');
      })
      .on('hidden.bs.modal', function (e) {
        $('div.itms').removeClass('sensored');
        startTimer(duration, 'countdown_timer');
      });
  });

  /* Click submit button */
  $('#submit_btn').click(function (e) {
    e.preventDefault();
    $('#test_form').submit();
  });

  /* Submit test */
  $('#test_form').submit(function (e) {
    e.preventDefault();

    let answers = [],
      testee = $(this).find('[name="testee"]').val(),
      reviewer = $(this).find('[name="reviewer"]').val();

    $(this).find('input.choices:checked').each(function () {
      let item = $(this).attr('name'),
        choice = $(this).val();
      answers.push({
        'item': item,
        'answer': choice
      });
    });

    answers = JSON.stringify(answers);

    if ($(this).find('input.choices:checked').length >= 1) {
      $.ajax({
        type: "POST",
        url: "./assets/hndlr/Questionnaire.php",
        data: {
          testee,
          reviewer,
          answers
        },
        success: function (res) {
          switch (res) {
            case 'true':
              SuccessModal('Submitted. Loading results, please wait...', 0, 0, 5000);
              $('#SuccessModal').on('hidden.bs.modal', function () {
                window.location.href = 'result.php';
              });
              break;

            default:
              ErrorModal(0, 0, 5000);
              console.log('ERR', res);
              break;
          }
        }
      });
    }

  });
});
/* Triggers */

/* Functions ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/* Fetch questionnaire items */
function RenderList(selected_reviewer) {

  $.post(
    './assets/hndlr/Questionnaire.php', {
      selected_reviewer
    },
    function (res) {

      if (res != 'err:fetch') {
        $.each(JSON.parse(res), function (idx, el) {
          let regex = /^\s*$/,
            optC = el.optionC,
            optD = el.optionD,
            optionC = '',
            optionD = '';

          switch (true) {
            case !optD.match(regex) && !optD.match(regex):
              optionC = `<label class="radios">
                    <input type="radio" class="radio-inline choices" name="${el.question_id}" value="c">
                    <span class="outside default">
                        <span class="inside default"></span>
                    </span>C. &nbsp; ${el.optionC}
                </label>`;
              optionD = `<label class="radios">
                    <input type="radio" class="radio-inline choices" name="${el.question_id}" value="d">
                    <span class="outside default">
                        <span class="inside default"></span>
                    </span>D. &nbsp; ${el.optionD}
                </label>`;
              break;
            case !optC.match(regex):
              optionC = `<label class="radios">
                    <input type="radio" class="radio-inline choices" name="${el.question_id}" value="c">
                    <span class="outside default">
                        <span class="inside default"></span>
                    </span>C. &nbsp; ${el.optionC}
                </label>`;
              break;
          }

          $('.items-container').append(`
          <div class="single-widget-area mb-30 box-shadow">
            <div class="mx-3 py-3 wow fadeInUp" data-wow-delay="500ms">
                <span class="h6 font-weight-bold">${idx + 1}.&nbsp;</span>
                <span class="h5 font-weight-bold">${el.question}</span>
                <label class="radios">
                  <input type="radio" class="radio-inline choices" name="${el.question_id}" value="a">
                  <span class="outside default">
                      <span class="inside default"></span>
                  </span>A. &nbsp; ${el.optionA}
                </label>
                <label class="radios">
                  <input type="radio" class="radio-inline choices" name="${el.question_id}" value="b">
                  <span class="outside default">
                      <span class="inside default"></span>
                  </span>B. &nbsp; ${el.optionB}
                </label>
                ${optionC}
                ${optionD}
            </div>
          </div>
          `);
        });
      } else {
        console.log('ERR', 'err:fetch');
      }
    }
  );
}

/* Stop countdown timer */
function endTimer(display) {
  $('.' + display).fadeOut(500);
  $('.' + display).fadeIn(500);
}

/* Start countdown timer */
function startTimer(duration, display) {
  let start = Date.now(),
    diff,
    hr,
    mins,
    secs,
    interval = null;

  function timer() {
    // get the number of seconds that have elapsed since startTimer() was called
    diff = duration * 60 - (((Date.now() - start) / 1000) | 0);

    // does the same job as parseInt truncates the float
    hr = (diff / 3600) | 0;
    mins = ((diff - hr * 3600) / 60) | 0;
    secs = diff % 60 | 0;

    hr = hr < 10 ? '0' + hr : hr;
    mins = mins < 10 ? '0' + mins : mins;
    secs = secs < 10 ? '0' + secs : secs;

    if (diff <= 600 && diff >= 301) {
      $('.' + display).addClass('text-warning');
    } else if (diff <= 300) {
      $('.' + display)
        .removeClass('text-warning')
        .addClass('text-danger');
    } else {
      $('.' + display).removeClass('text-warning text-danger');
    }

    $('.' + display).html(hr + ':' + mins + ':' + secs);

    if (diff == 1) {
      setInterval(endTimer, 1000, display);
    } else if (diff <= 0) {
      clearInterval(interval);
      interval = null;

      $('#submit_btn').hide();
      setTimeout(() => {
        // alert('function called');
      }, 3000);
    }
  }

  timer();
  interval = setInterval(timer, 1000);
}