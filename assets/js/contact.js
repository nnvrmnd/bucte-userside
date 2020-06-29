$(function () {
  $.post('./assets/hndlr/Contact.php', { contact: '1' }, function (res) {
    try {
      let contact = JSON.parse(res);

      $.each(contact, function (idx, el) {
        let open = moment(el.open, 'HH:mm').format('hh:mm A'),
          close = moment(el.close, 'HH:mm').format('hh:mm A');

        $('.contact-email').html(el.email);
        $('.contact-phone').html(el.phone);
        $('.contact-address').html(el.address);
        $('.contact-opentime').html(`${open} - ${close}`);
        $('.contact-embed').attr('src', el.embed);

        $('.contact-email-nav').html(
          `<i class="fa fa-envelope mr-1"></i> ${el.email}`
        );
        $('.contact-phone-nav').html(
          `<i class="icon_phone mr-1"></i> ${el.phone}`
        );
        $('.contact-address-nav').html(
          `<i class="fa fa-map-marker mr-1"></i> ${el.address}`
        );

        $('.contact-email-footer').html(
          `<i class="fa fa-envelope mr-1"></i> ${el.email}`
        );
        $('.contact-phone-footer').html(
          `<i class="icon_phone mr-1"></i> ${el.phone}`
        );
        $('.contact-address-footer').html(
          `<i class="fa fa-map-marker mr-1"></i> ${el.address}`
        );
      });
    } catch (e) {
      console.error('ERR', e.message);
      ErrorModal(5000);
    }
  });
});
