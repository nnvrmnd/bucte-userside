function RenderList(currentpage) {
  $.post('./assets/hndlr/Events.php', { upcoming: 'all' }, function (res) {
    try {
      $('#events').empty();
      $('.pagination').empty();
      let upcoming = JSON.parse(res),
        rowsperpage = 5,
        start = rowsperpage * currentpage,
        end = start + rowsperpage,
        paginate = upcoming.slice(start, end),
        pages = Math.ceil(upcoming.length / rowsperpage);

      $.each(paginate, function (idx, el) {
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
          desc.length >= 177
            ? desc.substring(0, 177) + '<b>&nbsp;...</b><p>'
            : desc;

        if (idx < paginate.length) {
          $('#events').append(`
						<div class="single-blog-post d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">

							<div class="post-thumbnail">
								<a href="./article.php?event=${event}"><img src="./files/events/${el.image}" alt="Event thumbnail"></a>
							</div>

							<div class="post-content">

								<div class="post-meta">
									<a href="javascript:void(0)" class="post-author default-pointer-here">${timeago}</a>
									<a href="javascript:void(0)" class="post-tutorial default-pointer-here">${eventcat}</a>
								</div>

								<a href="./article.php?event=${event}" class="post-title">Cdc Issues Health Alert Notice For Travelers To Usa From Hon</a>
								<p>${desc}</p>
								<a href="./article.php?event=${event}" class="btn continue-btn">Read More</a>
							</div>
						</div>
						`);
        }
      });

      for (let i = 0; i < pages; i++) {
        $('.pagination').append(
          `<li class="page-item page${i}"><a class="page-link page-btn" href="javascript:void(0)" data-target="${i}">${
            i + 1
          }</a></li>`
        );
      }

      if (currentpage != pages - 1) {
        $('.pagination').append(`
					<li class="page-item">
						<a class="page-link next-btn" href="javascript:void(0)">
							Next <i class="fa fa-angle-right"></i>
						</a>
					</li>
					`);
      }

      if (currentpage != 0) {
        $('.pagination').prepend(`
					<li class="page-item">
						<a class="page-link prev-btn" href="javascript:void(0)">
							<i class="fa fa-angle-left"></i> Previous
						</a>
					</li>
					`);
      }

      $('body').find(`li.page${currentpage}`).addClass('active');
      ScrollUp('.roberto-news-area');
    } catch (e) {
      console.log('ERR', e.message);
      $('.upcoming-events').addClass('d-none');
    }
  });
}

$(function () {
  let currentpage = 0;
  RenderList(currentpage);

  $('body').on('click', '.prev-btn', function () {
    currentpage--;
    RenderList(currentpage);
  });

  $('body').on('click', '.page-btn', function () {
    let page = $(this).attr('data-target');
    currentpage = page;
    RenderList(currentpage);
  });

  $('body').on('click', '.next-btn', function () {
    currentpage++;
    RenderList(currentpage);
  });
});
