$(function () {
  $.get('./assets/hndlr/GetData.php', { about: 'about' }, function (data) {
    JSON.parse(data).forEach((el) => {
      if (el.alias == 'vision') {
        $(`#vision`).html(el.content);
      } else if (el.alias == 'mission') {
        $(`#mission`).html(el.content);
      } else if (el.alias == 'objectives') {
        $(`#obj`).html(el.content);
      }
    });
  });
});
