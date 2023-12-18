Dropzone.autoDiscover = false;

(function ($) {
  let upSetting = {
    csrf_name: "csrf_token",
  };

  $.fn.setDropZone = function (url) {
    const INNERNOW = this.html();
    this.html(
      '<form action="' +
        url +
        '" class="dropzone text-center" style="border-color:#F2F2F2;border-radius:15px">' +
        INNERNOW +
        "</form>"
    );
    const myDropzone = new Dropzone(".dropzone", {
      maxFilesize: 50,
      acceptedFiles: ".jpeg,.jpg,.png,.pdf",
      parallelUploads: 1,
    });
    myDropzone.on("sending", function (file, xhr, formData) {
      var csrfName = upSetting.csrf_name;
      var csrfHash = $('[name="' + upSetting.csrf_name + '"]').val();
      formData.append(csrfName, csrfHash);
    });
    myDropzone.on("success", function (file, response) {
      $('[name="' + upSetting.csrf_name + '"]').val(response.token);
      let messagecolor = "danger";
      switch (response.success) {
        case 0:
          console.log("ERROR");
          break;
        case 1:
          console.log("SUCCESS");
          messagecolor = "success";
          window.location.reload(true);
          break;
        case 2:
          console.log("NO UPLOAD");
          break;
        default:
          console.log("ERROR");
          break;
      }
      $("#uploadmsg").html(
        '<small class="text-' +
          messagecolor +
          '">' +
          response.message +
          "</small>"
      );
    });
    $(".dz-button").html(
      '<div class="mb-3 text-secondary"><i class="fas fa-file-alt fa-2x"></i></div><span class="text-secondary">klik atau drag file kesini</span>'
    );
  };
})(jQuery);
