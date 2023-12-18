(function ($) {
  let tbOption = {
    icon: "fas fa-spinner",
    color: "secondary",
    size: "2",
    loader: "#loading",
    count: "#count_data",
    pagenow: "#halaman",
    pagemax: "#halaman_max",
    first: "first",
    last: "last",
    prev: "prev",
    next: "next",
    method: "html",
    timeout: 100,
  };

  const enableButton = (now, max) => {
    if (now < max) {
      $('button[data-page="' + tbOption.next + '"]').attr("disabled", false);
      $('button[data-page="' + tbOption.last + '"]').attr("disabled", false);
    }
    if (now > 1) {
      $('button[data-page="' + tbOption.prev + '"]').attr("disabled", false);
      $('button[data-page="' + tbOption.first + '"]').attr("disabled", false);
    }
  };

  const fillContent = (container, content, count, now, max) => {
    container.html(content);
    $(tbOption.count).html(count);
    $(tbOption.pagenow).html(now);
    $(tbOption.pagemax).html(max);
  };

  $.fn.setLoader = function (options = {}) {
    const loader = this;
    for (const key in options) {
      tbOption[key] = options[key];
    }
    loader.fadeOut(100, function () {
      loader.html(
        '<i class="' +
          tbOption.icon +
          " fa-" +
          tbOption.size +
          "x fa-pulse text-" +
          tbOption.color +
          '"></i>'
      );
    });
  };

  $.fn.setContent = function (
    url,
    params = {},
    options = {},
    afterload = () => {}
  ) {
    const failed =
      '<div class="d-flex" style="min-height:200px;height:30vh"><div class="w-100 my-auto text-center text-fade"><span>Failed to Get Content</span></div></div>';
    const container = this;
    for (const key in options) {
      tbOption[key] = options[key];
    }
    $(tbOption.loader).fadeIn(function () {
      setTimeout(() => {
        $.get(url, params, function (data, status) {
          if (status == "success") {
            fillContent(
              container,
              data.content,
              data.count,
              data.page_now,
              data.page_max
            );
            enableButton(parseInt(data.page_now), parseInt(data.page_max));
          } else {
            fillContent(container, failed, "0", "1", "1");
          }
          $(tbOption.loader).fadeOut();
          afterload();
        }).fail(function () {
          fillContent(container, failed, "0", "1", "1");
          $(tbOption.loader).fadeOut();
        });
      }, tbOption.timeout);
    });
  };

  $.fn.navTable = function (callfunc, options = {}) {
    const navs = this;
    for (const key in options) {
      navOpt[key] = options[key];
      tbOption[key] = options[key];
    }
    this.on("click", function () {
      navs.attr("disabled", true);
      const order = $(this).data("page");
      let page = $(tbOption.pagenow)[tbOption.method]();
      switch (order) {
        case "first":
          page = 1;
          break;
        case "last":
          const maxpage = $(tbOption.pagemax)[tbOption.method]();
          page = parseInt(maxpage);
          break;
        case "prev":
          page = parseInt(page) - 1;
          break;
        case "next":
          page = parseInt(page) + 1;
          break;
        default:
          page = parseInt(page);
          break;
      }
      callfunc(page);
    });
  };
})(jQuery);
