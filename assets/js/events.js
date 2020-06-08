$(function () {
	$('.rb-recents').addClass('d-none');

  let current_number = 1;
  let total_number = 0;
  $.get('./assets/hndlr/Events.php', { data: 'data' }, function (data) {
    let navNumber = Math.ceil(data / 5);
    if (navNumber > 1) {
      for (let i = navNumber; i != 0; --i) {
        $(`ul[class=pagination]`).prepend(
          ` <li class="page-item" id="page-item" style="margin: 1px"><a class="page-link">${i}</a></li>`
        );
      }
      $(`ul[class=pagination]`).append(
        `<li class="page-item" id="nextNumber" style="margin: 1px"><a class="page-link" href="#">Next <i class="fa fa-angle-right"></i></a></li>`
      );
    }
    total_number = navNumber;
  });
  //Initial Load Of Data is 0
  load_data(0);

  function load_data(page) {
    $.ajax({
      url: './assets/hndlr/Events.php',
      method: 'POST',
      data: { page: page },
      success: function (el) {
        let data = JSON.parse(el);
        data.length > 0
          ? data.forEach((el) => {
              let cipherData = cipher(el.evnt_id.toString()),
                link = `./article.php?event=${cipherData}`,
                formatted_date = getDateFormat(el.start_date);

              $(`div[id=events]`)
                .prepend(`<div class="single-blog-post d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
											<!-- Post Thumbnail -->
											<div class="post-thumbnail">
													<a href="${link}"><img src="./files/events/${el.image}" alt=""></a>
											</div>
											<!-- Post Content -->
											<div class="post-content">
													<!-- Post Meta -->
													<div class="post-meta">
															<a href="${link}" class="post-author">${formatted_date}</a>
															<a href="${link}" class="post-tutorial">${el.title}</a>
													</div>
													<!-- Post Title -->
													<a href="" class="post-title">${el.title}</a>
													<div class="overlap-text">${el.description}</div>
													<a href="${link}" class="btn continue-btn">Read More</a>
											</div>
									</div>`);
            })
          : $(`div[id=events]`)
              .css({ 'text-align': 'center' })
              .prepend(`<img src='./dist/img/bg-img/no_event.jpg'>`);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      },
    });
  }

  const changeActiveNumber = (page, current_number) => {
    $(`li a:contains(${current_number})`).css({
      'background-color': '#e8f1f8',
    });
    $(`li a:contains(${page})`).css({ 'background-color': '#1cc3b2' });
  };

  $(document).on('click', `li[id*="page-item"]`, function () {
    let page = $(this).text();
    if (current_number != page) {
      $(`div[id=events]`).empty();
      load_data(page - 1);
      changeActiveNumber(page, current_number);
      current_number = page;
    }
  });

  $(`li[id="nextNumber"]`).on('click', function () {
    let page = Number(current_number) + Number(1);
    let max = total_number;
    if (current_number != max) {
      $(`div[id=events]`).empty();
      load_data(page - 1);
      changeActiveNumber(page, current_number);
      current_number += 1;
    }
  });
});
