function setCookie(name, value = "", days = 5) {
  let date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  const expire = "; expires=" + date.toUTCString();
  document.cookie = name + "=" + value + expire + "; path=/";
}

function getCookie(name) {
  let result = null;
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) result = parts.pop().split(";").shift();
  return result;
}

$(function () {
  $("#darkswitch").change(function () {
    const DARK = $(this).prop("checked");
    const IMGNAME = "suretybond";
    if (DARK) {
      $("body").addClass("dark-mode");
      $(".main-header.navbar")
        .removeClass("navbar-white navbar-light")
        .addClass("navbar-dark");
      $("#contentwrapper")
        .removeClass("bg-pattern")
        .addClass("bg-pattern-dark");
      $(".surety-logo").attr("src", "/image/icon/" + IMGNAME + "_dark.png");
      setCookie("DRKMOD", 1, 7);
    } else {
      $("body").removeClass("dark-mode");
      $(".main-header.navbar")
        .removeClass("navbar-dark")
        .addClass("navbar-white navbar-light");
      $("#contentwrapper")
        .removeClass("bg-pattern-dark")
        .addClass("bg-pattern");
      $(".surety-logo").attr("src", "/image/icon/" + IMGNAME + ".png");
      setCookie("DRKMOD", 0, 1);
    }
  });

  $(".btn-expand").click(function () {
    const EXPAND = parseInt($(this).data("expand")) === 1;
    if (EXPAND) {
      $(this).data("expand", 0);
      $(this)
        .children("i")
        .removeClass("fa-compress-alt")
        .addClass("fa-expand-alt");
      $(".content-box").removeClass("container-fluid").addClass("container");
    } else {
      $(this).data("expand", 1);
      $(this)
        .children("i")
        .removeClass("fa-expand-alt")
        .addClass("fa-compress-alt");
      $(".content-box").removeClass("container").addClass("container-fluid");
    }
  });

  $('[class^="icheck-"]').on("change", function () {
    const CHECKBOX = $(this);
    const COLOR = CHECKBOX.attr("class")
      .split(" ")
      .filter(function (val) {
        return val.indexOf("icheck") !== -1;
      })
      .pop()
      .replace("icheck-", "");
    const METHOD = CHECKBOX.children("input").is(":checked")
      ? "addClass"
      : "removeClass";
    CHECKBOX.children("label")[METHOD]("text-" + COLOR);
    if (CHECKBOX.children("input").attr("type") == "radio")
      CHECKBOX.siblings()
        .children("label")
        .removeClass("text-" + COLOR);
  });
});
