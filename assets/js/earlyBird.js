const $ = require('jquery');
$(document).ready(function () {
    $('#modal-role').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let inputValue = button.data('role');// Extract info from data-* attributes
        $("#early_bird_role").attr("value", inputValue);// Assign role to input value
    })
});