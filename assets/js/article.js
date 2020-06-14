$(function () {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  let getEventParam = urlParams.get('event');
  let event = decipher(getEventParam);
  $.get('./assets/hndlr/GetData.php', { key: event }, function (data) {
    data = JSON.parse(data);

    // console.log(data)

    let desc = data.description,
      blockquote = new RegExp('<blockquote>', 'g'),
      ul = new RegExp('<ul>', 'g'),
      ol = new RegExp('<ol>', 'g'),
      deadline = data.reg_deadline,
      today = moment().utcOffset(8).format('x'),
      check_deadline = moment(data.reg_deadline, 'MM/DD/YY h:mm A').format('x');

    desc = desc.replace(
      blockquote,
      '<blockquote class="roberto-blockquote d-flex">'
    );
    desc = desc.replace(/\b&nbsp;\b/g, ' ');
    deadline = moment(deadline, 'MM/DD/YY h:mm A').format('MMM DD h:mm A');

    $('.event-title').html(data.title);
    $('.event-title2').html(`<h2>${data.title}</h2>`);
    $('.event-image').attr('src', `./files/events/${data.image}`);
    $('.event-details').html(`
		<dl class="row">
			<dt class="col-sm-3 text-muted h6">Schedule:</dt>
			<dd class="col-sm-9 h6">Jun 11 - Jun 12</dd>
			<dt class="col-sm-3 text-muted h6">Time:</dt>
			<dd class="col-sm-9 h6">12:00 AM - 12:00 AM</dd>
			<dt class="col-sm-3 text-muted h6">Registration deadline:</dt>
			<dd class="col-sm-9 h6">${deadline}</dd>
			<dt class="col-sm-3 text-muted h6">Venue:</dt>
			<dd class="col-sm-9 h6">${data.venue}</dd>
		</dl>
		`);
    $('.event-body').html(desc);
    $('.event-body').html(desc);

    $('.event-body').find('blockquote.d-flex').prepend(`
			<div class="icon">
				<img src="./assets/img/quote.png" alt="Quote">
				</div>
			`);

    $('.event-join').attr('data-target', data.evnt_id);

    if (today > check_deadline) {
      $('.event-join').html(`
				<button class="btn roberto-btn w-100" data-target="${data.evnt_id}">JOIN EVENT</button>
			`);
    }
  });

  /* Join event */
  $('body').on('click', '.event-join', function (e) {
    e.preventDefault();

    let participant = $('#user_rn').val(),
      event = $(this).attr('data-target'),
      form = [];

    if (user_rn.length <= 0) {
      $('#login').click();
    } else {
      form = { event, participant };
      form = JSON.stringify(form);

      PromptModal(10000, 'join_event', form, 'Join this event?');
    }
  });

  $('#yes_prompt').click(function (e) {
    e.preventDefault();

    let form = JSON.parse($(this).attr('data-target'));

    $.post('./assets/hndlr/Article.php', form, function (res) {
      if (res == 'true') {
        SuccessModal(
          'You are successfully signed up to this event.<br>See you there!',
          5000
        );
      } else if (res == 'joined') {
        ErrorModal(5000, 'You already signed up for this event.');
      } else {
        console.log('ERR', res);
        ErrorModal(5000);
      }
    });
  });
});
