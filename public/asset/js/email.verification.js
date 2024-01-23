$(function () {
  $(".inputmask")
    .inputmask()
    .on("input", function () {
      const VALUE = $(this).val();
      const parse = (val) => parseInt(val.replace(/[_\s+]/g, ""));
      $("#submitotp").prop("disabled", VALUE == "" || parse(VALUE) < 100000);
    });

  if ($("#sendbox").length > 0) {
    let params = {};
    params[$("#sendbox").data("name")] = $("#sendbox").data("csrf");
    setTimeout(() => {
      $.post(
        BaseURL + "setting/verification/send/email",
        params,
        function (data, status) {
          if (status == "success" && data.status.userdata) {
            $("#countdown").data("cd", 600);
            $("#sendbox").html("");
            $("#verifybox").removeClass("hide-content");
            setCountdown();
          } else {
          }
        }
      ).fail(() => {
        console.log("ERROR");
      });
    }, 3000);
  }

  if ($("#countdown").data("cd") != 0) {
    setCountdown();
  }
});

function setCountdown() {
  let countdown = setInterval(function () {
    let distance = $("#countdown").data("cd");

    let minutes = Math.floor(distance / 60);
    let seconds = Math.floor(distance % 60);
    if (minutes < 1) {
      $("#countdown").removeClass("text-primary").addClass("text-danger");
    }
    if (minutes < 10) minutes = "0" + minutes;
    if (seconds < 10) seconds = "0" + seconds;

    $("#countdown").html(minutes + " : " + seconds);
    $("#countdown").data("cd", distance - 1);

    if (distance <= 0) {
      clearInterval(countdown);
      $("#countdown").html(
        'Your OTP code is expired, <a href="/setting/verification/email">resend OTP</a> code to email.'
      );
      $("#submitotp").prop("disabled", true);
      $(".inputmask").val("").prop("disabled", true);
    }
  }, 1000);
}
