var PageScript = require("./app/pages/authorization/resource/resource");

$(function() {
  Main.setPageConfig(PageScript);
  PageScript.init();
  Main.init();
});