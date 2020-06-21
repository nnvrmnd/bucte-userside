function RenderList() {
  let queryString = window.location.search,
    urlParams = new URLSearchParams(queryString),
    getEventParam = urlParams.get('event'),
    event = decipher(getEventParam);

  if (CheckUrlParam('event') != undefined) {
    $.get('./assets/hndlr/GetData.php', { key: event }, function (data) {
      data = JSON.parse(data);

      let desc = data.description,
        blockquote = new RegExp('<blockquote>', 'g'),
        ul = new RegExp('<ul>', 'g'),
        ol = new RegExp('<ol>', 'g'),
        startdate = moment(data.start_date, 'YYYY/MM/DD h:mm A')
          .format('MMM DD')
          .toString(),
        enddate = moment(data.end_date, 'YYYY/MM/DD h:mm A')
          .format('MMM DD, YYYY')
          .toString(),
        starttime = moment(data.start_date, 'h:mm A')
          .format('h:mm A')
          .toString(),
        endtime = moment(data.end_date, 'h:mm A').format('h:mm A').toString(),
        regdeadline = moment(data.reg_deadline, 'YYYY/MM/DD h:mm A')
          .format('MMM DD, YYYY h:mm A')
          .toString(),
        today = moment().utcOffset(8).format('x'),
        check_deadline = moment(data.reg_deadline, 'YYYY/MM/DD h:mm A').format(
          'x'
        );

      desc = desc.replace(
        blockquote,
        '<blockquote class="roberto-blockquote d-flex">'
      );
      desc = desc.replace(/\b&nbsp;\b/g, ' ');

      $('.event-title').html(data.title);
      $('.event-title2').html(`<h2>${data.title}</h2>`);
      $('.event-image').attr('src', `./files/events/${data.image}`);
      $('.event-details').html(`
				<dl class="row">
					<dt class="col-sm-3 text-muted h6">Schedule:</dt>
					<dd class="col-sm-9 h6">${startdate} - ${enddate}</dd>
					<dt class="col-sm-3 text-muted h6">Time:</dt>
					<dd class="col-sm-9 h6">${starttime} - ${endtime}</dd>
					<dt class="col-sm-3 text-muted h6">Registration deadline:</dt>
					<dd class="col-sm-9 h6">${regdeadline}</dd>
					<dt class="col-sm-3 text-muted h6">Venue:</dt>
					<dd class="col-sm-9 h6">${data.venue}</dd>
				</dl>
				`);

      $('.event-body').find('blockquote.d-flex').html(`
				<div class="icon">
					<img src="./assets/img/quote.png" alt="Quote">
				</div>
				`);
      $('.event-body').append(desc);
      $('.event-btn').attr('data-target', data.evnt_id);

      if (today <= check_deadline) {
        $('.event-btn')
          .html('JOIN EVENT')
          .attr('data-target', data.evnt_id)
          .attr('id', 'join-btn');
      } else {
        $('.event-btn')
          .html('RATE THIS EVENT')
          .attr('data-target', data.evnt_id)
          .attr('id', 'rate-btn');
      }
    });
  } else {
    window.location.href = './events.php';
  }
}

$(function () {
  RenderList();

  /* Join event */
  $('body').on('click', '#join-btn', function (e) {
    e.preventDefault();

    let participant = $('#user_rn').val(),
      event = $(this).attr('data-target'),
      regex = /^\s*$/,
      form = [];

    if (participant.match(regex)) {
      $('#login').click();
    } else {
      form = { event, participant };
      form = JSON.stringify(form);

      PromptModal(10000, 'join_event', form, 'Join this event?');
    }
  });

  /* Rate event */
  $('body').on('click', '#rate-btn', function (e) {
    e.preventDefault();

    let ratee = $('#user_rn').val(),
      event = $(this).attr('data-target'),
      cipherEvent = cipher(event),
      regex = /^\s*$/,
      form = [];

    if (ratee.match(regex)) {
      $('#login').click();
    } else {
      $.post('./assets/hndlr/Article.php', { ratee, event }, function (res) {
        if (res == 'true') {
          window.location.href = `./survey.php?event=${cipherEvent}`;
        } else {
          console.log('ERR', res);
          ErrorModal(5000, 'You did not participate on this event.');
        }
      });
    }
  });

  $('#yes_prompt').click(function (e) {
    e.preventDefault();

    let form = JSON.parse($(this).attr('data-target'));

    $.post('./assets/hndlr/Article.php', form, function (res) {
      if (res === 'true') {
        SuccessModal(
          'You are successfully signed up to this event.<br>See you there!',
          5000
        );
      } else if (res === 'joined') {
        ErrorModal(5000, 'You already signed up for this event.');
      } else {
        console.log('ERR', res);
        ErrorModal(5000);
      }
    });
  });
});
