$(function () {
  /* Upcoming events */
  $.post('./assets/hndlr/Events.php', { upcoming: '3' }, function (res) {
    try {
      $('#upcoming').empty();
      let upcoming = JSON.parse(res);

      upcoming.sort((a, b) => {
        return (
          Math.abs(Date.now() - new Date(a.sort_date)) -
          Math.abs(Date.now() - new Date(b.sort_date))
        );
      });

      $.each(upcoming, function (idx, el) {
        let event = cipher(el.event_id),
          today = moment().format('x'),
          startdate = moment(el.start_date, 'YYYY/MM/DD h:mm A').format('x'),
          eventcat =
            today <= startdate
              ? moment(el.start_date, 'YYYY/MM/DD h:mm A')
                  .format('MMM DD, YYYY h:mm A')
                  .toString()
              : '',
          timeago =
            today <= startdate ? 'UP NEXT' : jQuery.timeago(el.start_date),
          title = el.title,
          desc = el.description;

        title =
          title.length >= 70 ? title.substring(0, 70) + '<b> ...</b>' : title;
        desc = desc.replace(/\b&nbsp;\b/g, ' ');
        desc =
          desc.length >= 77 ? desc.substring(0, 77) + '<b>...</b><p>' : desc;

        $('#upcoming').append(`
					<div class="col-12 col-md-6 col-lg-4">
						<div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms"
							style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
						<a href="./article.php?event=${event}" class="post-thumbnail">
							<img src="./files/events/${el.image}" class="upcoming-thumb" alt="Event thumbnail">
						</a>

						<div class="post-meta">
							<a href="javascript:void(0)" class="post-date default-pointer-here">${timeago}</a>
							<a href="javascript:void(0)" class="post-catagory default-pointer-here">${eventcat}</a>
						</div>

						<a href="./article.php?event=${event}" class="post-title">${title}</a>
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
      console.error('ERR', e.message);
      // $('.upcoming-events').addClass('d-none');
    }
  });

  /* Welcome image */
  $.post('./assets/hndlr/Home.php', { image: 'img' }, function (res) {
    if (res !== 'empty') {
      $('img#image1').attr('src', './files/contents/' + res);
    }
  });

  /* Welcome content */
  $.post('./assets/hndlr/Home.php', { welcome: 'all' }, function (res) {
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
});
