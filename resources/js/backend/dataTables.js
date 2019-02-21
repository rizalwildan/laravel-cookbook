try {
    window.$ = window.jQuery = require('jquery');
    require('datatables.net-bs4')($);
    require('datatables.net-buttons-bs4');
    require('datatables.net-responsive-bs4');
    require('datatables.net-select-bs4');
} catch (e) {}