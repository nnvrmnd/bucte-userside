

/* Commons */
let lvl_sesh = sessionStorage.getItem('lvl'),
  rvwr_sesh = sessionStorage.getItem('rvwr');

/* Triggers */
$(function() {
	$('.rb-elet').addClass('d-none');

  /* Select level */
  $('.level').click(function(e) {
    e.preventDefault();

    let selected = $(this).attr('data-target');

    sessionStorage.setItem('lvl', selected);
    window.location.href = 'reviewer-list.php';
  });
});
/* Triggers */
