global.jQuery = global.$ = require("jquery");
require("bootstrap-sass");
global.moment = require("moment");
var SiteModule = require("./app/pages/site/site");
var SmoothScroll = require("smooth-scroll");

$(function() {
  $(".wrapper").fadeIn("slow");
  $("body").scrollspy();

  /**
   * Salva a sessão que o usuário passou,
   * caso ele recarregue o site a última sessão visitada será exibida
   */
  $("body").on("activate.bs.scrollspy", function(e) {
    history.replaceState({}, "", $("a[href^='#']", e.target).attr("href"));
  });

  /**
   * Arranjar uma solução decente algum dia
   * Hack para o smoothscroll
   */
  var numberOfAjaxCallsAtLoad = 1;
  $(document).ajaxStop(function() {
    numberOfAjaxCallsAtLoad--;
    if (numberOfAjaxCallsAtLoad === 0) {
        scroll = new SmoothScroll('a[href*="#"]');
    }
  });

  // inicializar módulo do site
  SiteModule.init();
});
