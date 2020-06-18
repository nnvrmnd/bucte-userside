$(function () {
  let urlParams = new URLSearchParams(window.location.search),
    event = decipher(urlParams.get('event')),
    eventCiphered = cipher(event),
    ratee = $('#user_rn').val();

  $.post('./assets/hndlr/Survey.php', { guest: ratee, event }, function (res) {
    console.log(res);

    if (res == 'done') {
      SuccessModal(
        'You have already submitted a survey for this event. Thank you!',
        5000
      );
      $('#SuccessModal').on('hidden.bs.modal', function () {
        window.location.href = `./article.php?event=${eventCiphered}`;
      });
    }
  });

  $.post('./assets/hndlr/Article.php', { ratee, event }, function (res) {
    if (res != 'true') {
      ErrorModal(5000, 'You did not participate on this event.');
      $('#ErrorModal').on('hidden.bs.modal', function () {
        window.location.href = `./article.php?event=${eventCiphered}`;
      });
    }
  });

  /* Render event */
  if (event != undefined) {
    $.get('./assets/hndlr/GetData.php', { key: event }, function (data) {
      data = JSON.parse(data);

      let desc = data.description,
        blockquote = new RegExp('<blockquote>', 'g'),
        ul = new RegExp('<ul>', 'g'),
        ol = new RegExp('<ol>', 'g'),
        deadline = data.reg_deadline,
        today = moment().utcOffset(8).format('x'),
        check_deadline = moment(data.reg_deadline, 'MM/DD/YY h:mm A').format(
          'x'
        );

      desc = desc.replace(
        blockquote,
        '<blockquote class="roberto-blockquote d-flex">'
      );
      desc = desc.replace(/\b&nbsp;\b/g, ' ');
      deadline = moment(deadline, 'MM/DD/YY h:mm A').format('MMM DD h:mm A');

      if (today <= check_deadline) {
        window.location.href = `./article.php?event=${eventCiphered}`;
      }

      $('.event-title').html('Quick Survey');
      $('.event-title2').html(`<h2>${data.title}</h2>`);
      $('.event-image').attr('src', `./files/events/${data.image}`);

      $('.event-body').find('blockquote.d-flex').html(`
				<div class="icon">
					<img src="./assets/img/quote.png" alt="Quote">
				</div>
				`);

      $('.event-btn')
        .html('SUBMIT SURVEY')
        .attr('data-target', data.evnt_id)
        .attr('id', 'survey-btn');
    });
  }

  /* Render survey */
  $.post('./assets/hndlr/Survey.php', { getsurvey: 'all' }, function (res) {
    try {
      $('.event-body').append('<form id="survey_form">');

      $.each(JSON.parse(res), function (idx, el) {
        let regex = /^\s*$/,
          optC = el.optionC,
          optD = el.optionD,
          optionC = '',
          optionD = '';

        switch (true) {
          case !optD.match(regex) && !optD.match(regex):
            optionC = `<label class="radios">
                    <input type="radio" class="radio-inline choices" name="${el.assessment_id}" value="c">
                    <span class="outside default">
                        <span class="inside default"></span>
                    </span>C. &nbsp; ${el.optionC}
                </label>`;
            optionD = `<label class="radios">
                    <input type="radio" class="radio-inline choices" name="${el.assessment_id}" value="d">
                    <span class="outside default">
                        <span class="inside default"></span>
                    </span>D. &nbsp; ${el.optionD}
                </label>`;
            break;
          case !optC.match(regex):
            optionC = `<label class="radios">
                    <input type="radio" class="radio-inline choices" name="${el.assessment_id}" value="c">
                    <span class="outside default">
                        <span class="inside default"></span>
                    </span>C. &nbsp; ${el.optionC}
                </label>`;
            break;
        }

        $('#survey_form').append(`
          <div class="single-widget-area mb-30 box-shadow">
            <div class="mx-3 py-3 wow fadeInUp" data-wow-delay="500ms">
							<span class="h6 font-weight-bold">${idx + 1}.&nbsp;</span>
							<span class="h5 font-weight-bold">${el.question}</span>
							<label class="radios">
								<input type="radio" class="radio-inline choices" name="${
                  el.assessment_id
                }" value="a">
								<span class="outside default">
									<span class="inside default"></span>
								</span>A. &nbsp; ${el.optionA}
							</label>
							<label class="radios">
								<input type="radio" class="radio-inline choices" name="${
                  el.assessment_id
                }" value="b">
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
    } catch (e) {
      console.error(e.message);
      ErrorModal(5000);
    }
  });

  /* Click submit */
  $('body').on('click', '#survey-btn', function (e) {
    e.preventDefault();

    $('body').find('form#survey_form').submit();
  });

  /* Submit survey */
  $('body').on('submit', '#survey_form', function (e) {
    e.preventDefault();

    let form = $(this).serializeArray();

    form = JSON.stringify(form);

    WaitModal(5000);

    $.post(
      './assets/hndlr/Survey.php',
      { form, ratee, survey: event },
      function (res) {
        if (res == 'true') {
          SuccessModal('Thank you for your time.<br>We appreciate it!', 10000);
          $('#SuccessModal').on('hidden.bs.modal', function () {
            window.location.replace('/app/');
          });
        } else {
          console.error('ERR', res);
          ErrorModal(5000);
        }
      }
    );
  });
});
