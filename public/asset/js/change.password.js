$(function () {
  const passwords_match = () => {
    const NEWPASS = $("#newpass").val();
    const CONFIRM = $("#confirmpass").val();
    return CONFIRM != "" && NEWPASS == CONFIRM;
  };

  $("#newpass").on("input", function () {
    const PASSVAL = $(this).val();

    let score = 0;
    let scorer = [];
    scorer.push(new RegExp("(?=.*[a-z])"));
    scorer.push(new RegExp("(?=.*[A-Z])"));
    scorer.push(new RegExp("(?=.*[0-9])"));
    scorer.push(new RegExp("(?=.{8,})"));
    scorer.push(new RegExp("(?=.*[^a-zA-Z0-9])"));

    for (let index = 0; index < scorer.length; index++) {
      if (PASSVAL.match(scorer[index])) score++;
    }

    const STATEXT = [
      "",
      "Too Simple",
      "Simple",
      "That's Good",
      "Great Password",
      "Amazing!",
    ];

    const STYLES = [
      "secondary",
      "danger",
      "warning",
      "success",
      "success",
      "success",
    ];

    $("#progresstext")
      .html(STATEXT[score])
      .attr("class", "text-bold text-" + STYLES[score]);

    $('[role="progressbar"]')
      .attr("class", "progress-bar bg-" + STYLES[score])
      .attr("aria-valuenow", 20 * score)
      .attr("style", "width:" + 20 * score + "%");

    $('button[type="submit"]').prop("disabled", score == 0);
  });

  $("#confirmpass").on("input", function () {
    const THISVAL = $(this).val();
    $(this).removeClass("is-invalid");
    $("#errormsg").html("");
    if ($("#newpass").val().length < THISVAL.length + 1 && THISVAL != "") {
      if (!passwords_match()) {
        $(this).addClass("is-invalid");
        $("#errormsg").html("Please make sure your passwords match");
      }
    }
  });

  $('form[method="post"]').on("submit", function (submit) {
    if (!passwords_match()) {
      submit.preventDefault();
      $("#confirmpass").addClass("is-invalid");
      $("#errormsg").html("Please make sure your passwords match");
    }
  });
});
