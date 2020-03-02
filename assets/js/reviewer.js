'use_strict';

/* Commons */
let lvl_sesh = sessionStorage.getItem('lvl'),
  rvwr_sesh = sessionStorage.getItem('rvwr');

/* Triggers */
$(function() {
  /* Select level */
  $('.level').click(function(e) {
    e.preventDefault();

    let selected = $(this).attr('data-target');

    sessionStorage.setItem('lvl', selected);
    window.location.href = 'reviewer-list.php';
  });
});
/* Triggers */
