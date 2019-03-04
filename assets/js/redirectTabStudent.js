const $ = require('jquery');

$(document).ready(function () {
    if (window.location.hash) {
        $(window.location.hash).tab('show');
    }
});

