/* Fetch list */
function RenderList() {
  // change thumbnail according to file format
  function file_format(format) {
    if (format.match(/\b(\w*image\w*)\b/gi)) {
      return 'jpg.png';
    } else if (format.match(/\b(\w*presentation\w*)\b/gi)) {
      return 'ppt.png';
    } else if (format.match(/\b(\w*word\w*)\b/gi)) {
      return 'res.png';
    } else if (format.match(/\b(\w*zip\w*)\b/gi)) {
      return 'zip.png';
    } else if (format.match(/\b(\w*text\w*)\b/gi)) {
      return 'txt.png';
    } else if (format.match(/\b(\w*spreadsheet\w*)\b/gi)) {
      return 'xls.png';
    } else if (format.match(/\b(\w*pdf\w*)\b/gi)) {
      return 'pdf.png';
    }
  }

  $.ajax({
    type: 'POST',
    url: './assets/hndlr/Library.php',
    data: { fetchresources: 'all' },
    success: function (res) {
      $('.resources-container').empty();
      try {
        let resources = JSON.parse(res);

        resources.sort((a, b) => {
          if (a.format > b.format) {
            return 1;
          } else {
            return -1;
          }
        });

        $.each(resources, function (idx, el) {
          let attachment_title = el.title,
            attachment_format = el.attachment,
            attachment_filename,
            description = el.description,
            uploaded_date,
            uploaded_time,
            uploaded_at;

          description = !description.match(/^\s*$/)
            ? `&ndash; ${el.description}`
            : '<i><small>No description...</small></i>';

          attachment_title = attachment_title.replace(/[^A-Za-z0-9_.-]/g, '_');
          attachment_format = attachment_format.split('.');
          attachment_filename = `${attachment_title}.${attachment_format[1]}`;

          $('.resources-container').append(`
					<div class="single-recent-post d-flex pointer-here reviewer" data-target="${
            el.reviewer_id
          }">
						<div class="post-thumb">
							<a href="javascript:void(0)"><img src="./assets/img/file_format/${file_format(
                el.format
              )}" alt="File format"></a>
						</div>
						<div class="post-content">
							<a href="javascript:void(0)" class="font-weight-bold post-title mb-2" style="font-size:18px">
									${el.title}
							</a>
							<p class="mb-0">${description}</p>
							<a href="./files/resources/${
                el.attachment
              }" download="${attachment_filename}" class="btn btn-sm btn-link ">Download</a>
						</div>
					</div>
					`);
        });
      } catch (e) {
        console.error('ERR', e.message);
        /* $('.resources-container').html(`
				<div class="col notfound mb-5 pb-5">
					<div class="d-none d-sm-block notfound-404">
						<h1>Oops!</h1>
					</div>
					<h2 class="ml-2">Oops! List is empty</h2>
					<p class="ml-2">No items to display</p>
				</div>
				`); */
      }
    },
  });
}

$(function () {
  RenderList();
});
