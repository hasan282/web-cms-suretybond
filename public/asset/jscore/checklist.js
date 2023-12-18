(function ($) {
  $.fn.checkList = function (list, callback = () => {}) {
    const CHECKALL = this;
    CHECKALL.change(function () {
      if (CHECKALL.is(":checked")) {
        $(list + ":not(:checked)").each(function () {
          $(this).trigger("click");
        });
      } else {
        $(list + ":checked").each(function () {
          $(this).trigger("click");
        });
      }
    });
    $(list).change(function () {
      let all_checked = false;
      if ($(this).is(":checked")) {
        if ($(list + ":checked").length == $(list).length) {
          CHECKALL.prop("checked", true);
          all_checked = true;
        }
      } else {
        CHECKALL.prop("checked", false);
        all_checked = false;
      }
      const one_checked = $(list + ":checked").length > 0;
      callback(one_checked, all_checked);
    });
  };
})(jQuery);
