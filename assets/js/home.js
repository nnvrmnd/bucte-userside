$(function () {
  /* Welcome content */
  $.post('./assets/hndlr/Homepage.php', { welcome: 'all' }, function (res) {
    try {
      let welcome = JSON.parse(res);
      $.each(welcome, function (idx, el) {
        $('#title').html(el.title);
        $('#content').html(el.content);
      });
    } catch (e) {
      console.log('ERR', e.message);
      $('#title').html(`<i>PAGE UNDER MAINTENANCE</i>`);
      $('#content').html('<p>Please check after some time.</p>');
    }
  });

  /* Upcoming events */
  $.post('./assets/hndlr/Events.php', { upcoming: '3' }, function (res) {
    try {
      $('#upcoming').empty();
      let upcoming = JSON.parse(res);

      $.each(upcoming, function (idx, el) {
        let event = cipher(el.event_id),
          today = moment().format('x'),
          startdate = moment(el.start_date, 'MM/DD/YYYY').format('x'),
          timeago =
            today <= startdate
              ? moment(el.start_date, 'MM/DD/YYYY')
                  .format('MMM DD, YYYY h:mm A')
                  .toString()
              : jQuery.timeago(el.start_date),
          eventcat = today <= startdate ? 'COMING UP' : '',
          desc = el.description;

        desc = desc.replace(/\b&nbsp;\b/g, ' ');
        desc =
          desc.length >= 77 ? desc.substring(0, 77) + '<b>...</b><p>' : desc;

        $('#upcoming').append(`
				<div class="col-12 col-md-6 col-lg-4">
					<div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms"
						style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
					<a href="./article.php?event=${event}" class="post-thumbnail">
						<img src="./files/events/${el.image}" class="upcoming-thumb"
							style="height: 170px; width: 100%; max-width: 300px;" alt="Event thumbnail">
					</a>

					<div class="post-meta">
						<a href="javascript:void(0)" class="post-date default-pointer-here">${timeago}</a>
						<a href="javascript:void(0)" class="post-catagory default-pointer-here">${eventcat}</a>
					</div>

					<a href="./article.php?event=${event}" class="post-title">${el.title}</a>
					<p>${desc}</p>
					<a href="./article.php?event=${event}" class="btn continue-btn">
						<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
					</a>
					</div>
				</div>
				`);

        return idx < 2;
      });
    } catch (e) {
      console.log('ERR', e.message);
      $('.upcoming-events').addClass('d-none');
    }
  });
});
