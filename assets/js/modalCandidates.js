const $ = require('jquery');

$(document).ready(function () {
  $('#ModalCenter').on('show.bs.modal', function (event) {
    const modal = $(this);
    const button = $(event.relatedTarget);
    const id = button.data('candidates');
    $.get( "/student/" + id, function( data ) {
      modal.find('.modal-body').html(data);
    });
  });
});

