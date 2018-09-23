global.jQuery = global.$ = require("jquery");
require("bootstrap-sass");
global.moment = require("moment");
require("datatables.net")(window, $);
require("datatables.net-bs")(window, $);

require("admin-lte/plugins/slimScroll/jquery.slimscroll");
require("admin-lte/plugins/pace/pace");
require("admin-lte/dist/js/app");
Main = require("./app/models/Main");

$(document).on("change", ".btn-file :file", function() {
  var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input
      .val()
      .replace(/\\/g, "/")
      .replace(/.*\//, "");
  input.trigger("fileselect", [numFiles, label]);
});

$('.btn-file :file').on('fileselect', function (event, numFiles, label) {
    $(this).siblings('.btn-file-name').text(label);
});

// show footer
$(".main-footer").toggle("slide");

$("section.content").on("click", "td.details-control", function (e) {
    e.stopPropagation();
});

$(document).ajaxStart(function () {
    Pace.restart();
});

Main.setConfig({
    toolbarElement: '.system-toolbar',
    toolbarItem: 'li',
    toolbarSelectedItem: '.cats-selected-row',
    toolbarContainer: '.control-sidebar',
    toolbarContainerOpen: 'control-sidebar-open'
});