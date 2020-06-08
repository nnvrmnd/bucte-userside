/* Fetch list */
function RenderList() {
  $.ajax({
    type: 'POST',
    url: './assets/hndlr/Gallery.php',
    data: { fetchgallery: 'all' },
    success: function (res) {
      $('.gallery-container').empty();

      try {
        let gallery = JSON.parse(res);

        $.each(gallery, function (idx, el) {
					let start_date,
					start_time,
					start_at;

					start_date = moment(el.start_at).format('Do MMM YYYY');
					start_time = moment(el.start_at).format('h:mm A');
					start_at = `${start_date} at ${start_time}`;

          $('.gallery-container').append(`
						<li>
							<a href="./files/events/${el.image}" class="fancybox" data-fancybox="gallery" data-caption="${el.title}<br>${start_at}">
								<img alt="Image placeholder" src="./files/events/${el.image}" class="img-fluid rounded" title="Click to view image">
							</a>
						</li>
					`);
        });
      } catch (e) {
        console.error('ERR', e.message);
      }
    },
  });
}

$(function () {
  RenderList();

  $('body').fancybox({
    selector: '[data-fancybox="gallery"]',
		buttons: ['zoom', 'thumbs', 'close'],
		thumbs : {
			autoStart : true
		}
  });
});
