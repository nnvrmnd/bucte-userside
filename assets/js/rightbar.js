$(function () {
  $.post('./assets/hndlr/Events.php', { upcoming: '4' }, function (res) {
    try {
      $('#upcoming').empty();
      let upcoming = JSON.parse(res);

      $.each(upcoming, function (idx, el) {
        let event = cipher(el.event_id),
          today = moment().format('x'),
          startdate = moment(el.start_date, 'MM/DD/YYYY').format('x'),
          timeago =
            today <= startdate ? 'COMING SOON' : jQuery.timeago(el.start_date),
          eventcat =
            today <= startdate
              ? moment(el.start_date, 'MM/DD/YYYY')
                  .format('MMM DD, YYYY h:mm A')
                  .toString()
              : '&emsp;',
          desc = el.description;

        desc = desc.replace(/\b&nbsp;\b/g, ' ');
        desc =
          desc.length >= 77
            ? desc.substring(0, 77) + '<b>&nbsp;...</b><p>'
            : desc;

        $('#rightbar_event').append(`
				<div class="single-recent-post d-flex">
					<div class="post-thumb">
						<a href="./article.php?event=${event}"><img src="./files/events/${el.image}" alt="Event thumbnail"></a>
					</div>

					<div class="post-content">
						<div class="post-meta">
							<a href="javascript:void(0)" class="post-author default-pointer-here">${timeago}</a>
							<a href="javascript:void(0)" class="post-tutorial default-pointer-here">${eventcat}</a>
						</div>
						<a href="./article.php?event=${event}" class="post-title">${el.title}</a>
					</div>
				</div>
				`);

        return idx < 3;
      });
    } catch (e) {
      console.log('ERR', e.message);
      $('.upcoming-events').addClass('d-none');
    }
  });
});
