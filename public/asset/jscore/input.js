(function ($) {
  let inOption = {
    placeholder: "Tanggal",
  };

  const dateConvert = function (date, tipe = 1) {
    let dateresult = null;
    let dt = [];
    const month =
      "Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember".split(
        ","
      );
    switch (tipe) {
      case 1:
        dt = date.split("-");
        if (dt.length == 3)
          dateresult = parseInt(dt[2]) + " " + month[dt[1] - 1] + " " + dt[0];
        break;
      case 2:
        dt = date.split("-");
        if (dt.length == 3) dateresult = dt[2] + "/" + dt[1] + "/" + dt[0];
        break;
      case 11:
        dt = date.split("/");
        if (dt.length == 3)
          dateresult = parseInt(dt[2]) + " " + month[dt[1] - 1] + " " + dt[0];
        break;
      case 12:
        dt = date.split("/");
        if (dt.length == 3) dateresult = dt[2] + "-" + dt[1] + "-" + dt[0];
        break;
      case 13:
        dt = date.split("/");
        if (dt.length == 3)
          dateresult = parseInt(dt[0]) + " " + month[dt[1] - 1] + " " + dt[2];
        break;
      default:
        dateresult = null;
        break;
    }
    return dateresult;
  };

  const dateRange = function (from, to) {
    let dateFrom = from != "" ? new Date(from).getTime() : 0;
    let dateTo = to != "" ? new Date(to).getTime() : 0;
    if (dateFrom > 0 && dateTo - dateFrom > 0) {
      return Math.ceil((dateTo - dateFrom) / (1000 * 3600 * 24)) + 1;
    }
    return 0;
  };

  const daysAdd = function (date, days) {
    if (date != "" && days > 0) {
      let dateTo = new Date(date);
      dateTo.setDate(dateTo.getDate() + days);
      return dateTo.toISOString().substring(0, 10);
    }
    return null;
  };

  $.fn.inputDate = function (options = {}) {
    for (const key in options) {
      inOption[key] = options[key];
    }
    this.each(function () {
      const ELEID = $(this).attr("id");
      const ELEMENT = $("#" + ELEID);
      const FORM =
        '<div class="input-group-prepend" data-target="#' +
        ELEID +
        '" data-toggle="datetimepicker"><div class="input-group-text"><i class="fa fa-calendar-alt"></i></div></div><input type="hidden" id="val_' +
        ELEID +
        '" name="' +
        ELEID +
        '"><input type="text" class="form-control datetimepicker-input" id="' +
        ELEID +
        '_input" data-target="#' +
        ELEID +
        '" placeholder="' +
        inOption.placeholder +
        '">';
      ELEMENT.addClass("input-group")
        .data("target-input", "nearest")
        .html(FORM);
      ELEMENT.datetimepicker({
        format: "DD/MM/YYYY",
      });
      const PREVIEW = "#" + ELEID + "_input";
      $(PREVIEW).on("focus", function () {
        const PREVAL = $(this).prev().val();
        $(this).val(dateConvert(PREVAL, 2));
      });
      $(PREVIEW).on("focusout", function () {
        const PREVAL = $(this).prev().val();
        $(this).val(dateConvert(PREVAL));
      });
      $(PREVIEW)
        .prev()
        .on("input", function () {
          const VALS = $(this).val();
          $(this).val(dateConvert(VALS, 12));
          $(PREVIEW).val(dateConvert(VALS, 13));
        });
    });
  };

  $.fn.dateValue = function (value) {
    this.each(function () {
      const ELEID = $(this).attr("id");
      const VALS = dateConvert(value, 2);
      $("#val_" + ELEID).val(value);
      $("#" + ELEID + "_input")
        .val(VALS)
        .trigger("change");
    });
  };

  $.fn.rangeFrom = function (from, to) {
    const INDAYS = this;
    INDAYS.on("keyup", function () {
      const DATETO = daysAdd(
        $("#val_" + from).val(),
        parseInt($(this).val()) - 1
      );
      if (DATETO !== null) {
        $("#val_" + to).val(DATETO);
        $("#" + to + "_input")
          .val(dateConvert(DATETO, 2))
          .trigger("change");
      }
    });
    $("#val_" + from + ",#val_" + to).on("input", function () {
      INDAYS.val(dateRange($("#val_" + from).val(), $("#val_" + to).val()));
    });
  };
})(jQuery);
