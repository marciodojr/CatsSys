var PageScript = require("./app/pages/authorization/role/role");

$(function() {
  Main.setPageConfig(PageScript);
  PageScript.init();
  Main.init();
});