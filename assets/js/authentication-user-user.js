var PageScript = require("./app/pages/authentication/user/user");

$(function() {
  Main.setPageConfig(PageScript);
  PageScript.init();
  Main.init();
});
