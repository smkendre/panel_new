$(document).ready(function () {
  $(".joinNowLink").click(function () {
    var dt = $(this).attr("data-date");
    var tm = $(this).attr("data-time");
    var url = $(this).attr("data-url");
    var session = $(this).attr("data-id");
    var timeLeft = $(this).attr("data-timeLeft");

    if (timeLeft > 5) {
      jQuery.fancybox.open(
        '<div class="fancybox_content"><h2>Session will be </h2> <h4>Live On</h4> <h5>' +
          dt +
          " | " +
          tm +
          "</h5> <p>Please come back later.</p></div>"
      );
    } else {
      if (url == "") {
        jQuery.fancybox.open(
          '<div class="fancybox_content"><h2>Your joining links will be created in 15 minutes</h2></div>'
        );
      } else {
        $.ajax({
          url: "track-event",
          data: {
            type: "session",
            value: url,
            session_id: session,
            _token: $("input[name='_token']").val(),
          },
          type: "post",
          success: function () {
            window.open(join_url, "_blank");
          },
        });
      }
    }
  });

  $(".assetTrack").click(function () {
    var join_url = $(this).attr("href");
    var session_id = $(this).attr("data-id");

    $.ajax({
      url: JS_URL + "track-event",
      data: {
        type: "asset",
        value: join_url,
        session_id: session_id,
        _token: $("input[name='_token']").val(),
      },
      type: "post",
      success: function () {
        // window.open(join_url, "_blank");
      },
    });
  });
});

function video_tracking(url, type, id) {
  $.ajax({
    url: JS_URL + "track-event",
    data: {
      type: type,
      value: url,
      session_id: id,
      _token: $("input[name='_token']").val(),
    },
    type: "POST",
    dataType: "json",
    success: function (response) {
      if (response.status == 200) $("#active_video").val(response.id);
    },
  });

  // $.fancybox.open({
  //   src: url,
  //   afterClose: function () {
  //     video_close_tracking();
  //   },
  // });
}

function video_close_tracking() {
  $.ajax({
    url: JS_URL + "track-close-event",
    data: {
      value: $("#active_video").val(),
      _token: $("input[name='_token']").val(),
    },
    type: "POST",
    success: function (response) {
      $("#active_video").val("");
    },
  });
}

function register_session_users(event_id, users) {
  $.ajax({
    url: JS_URL + "track-live-session",
    data: { event: event_id, users: users },
    // type: "POST",
    dataType: "json",
    success: function (response) {
      console.log(response);
    },
  });
}

var onIdle = function (timeOutSeconds, func) {
  //Idle detection
  var idleTimeout;
  var activity = function () {
    clearTimeout(idleTimeout);
    // console.log('to cleared');
    idleTimeout = setTimeout(func, timeOutSeconds * 1000);
  };
  $(document).on("mousedown mousemove keypress", activity);
  activity();
};
onIdle(90, function () {
  //location.reload();
});

function show_countdown() {
  $(".countdown").each(function () {
    $(".live_link").hide();
    $(".joinNowLink").hide();

    var dt = $(this).attr("data-date");
    var tm = $(this).attr("data-time");
    var url = $(this).attr("data-url");
    var id = $(this).attr("id");
    var etm = $(this).attr("data-end-time");
    var title = $(this).attr("data-title");

    // Set the date we're counting down to
    var countDownDate = new Date(dt + " " + tm).getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {
      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      if (hours < 10) hours = "0" + hours;
      if (minutes < 10) minutes = "0" + minutes;
      if (seconds < 10) seconds = "0" + seconds;

      var clockHtml = '<img src="' + JS_URL + 'images/clock.png" alt="">';

      if (days != 0) clockHtml += days + " Days ";
      if (hours != 0) clockHtml += hours + " Hrs ";
      if (minutes != 0) clockHtml += minutes + " Min ";

      clockHtml += seconds + " Sec ";
      // Output the result in an element with id="demo"
      $("#" + id).html(clockHtml);

      // Output the result in an element with id="demo"
      // $("#" + id).html(
      //   '<img src="' +
      //     JS_URL +
      //     'images/clock.png" alt="">' +
      //     days +
      //     " Days " +
      //     hours +
      //     " Hrs " +
      //     minutes +
      //     " Min " +
      //     seconds +
      //     " Sec "
      // );
      // console.log(distance);
      // If the count down is over, write some text
      //console.log(days + " Days " + hours + " Hrs " + + minutes + " Min ");
      // var content =
      //   ' <div id="announsmes" class="popmain3"><div class="popmainheading">LIVE SESSION ALERT</div><div class="popmain1con1"><div class="popupformmain1"><h5 class="livesessiontitle">' +
      //   title +
      //   ' is <i>live Now</i></h5><br><div class="btn2 tac"><a href="#">Join Now</a></div></div></div></div>';

      if (days == 0 && hours == 0 && minutes < 6) {
        // $("#join-" + id).attr("href", url);
        $("#join-" + id).attr("href", url);

        $("#join-" + id).attr("data-timeLeft", minutes);
        //  $(".conzoomlink a").attr("href", url);
      }
      // console.log("distance: " + distance);

      // if (days == 0 && hours == 0 && minutes == 0 && seconds == 2) {
      //   $(".livesessiontitle").html(title + " is <i>live Now</i>");
      //   $.fancybox.open($("#livealert"));
      // }
      if (distance < 0) {
        $("#live-" + id).show();
        $("#join-" + id).show();
        // $("#directLink-" + id).removeClass("hide");
        $("#" + id).html("");
        $("#parent-" + id).addClass("popconfboxactive");
        // $(".conzoomlink a").attr("href", url);
        $("#join-" + id).attr("href", url);
        $("#join-" + id).attr("data-timeLeft", minutes);
        clearInterval(x);
      }

      // if (days == 0 && hours == 0 && minutes == -10) {
      //   $.fancybox.open($("#livealert"));
      // }
    }, 1000);
  });
}

function ajax_agenda_load() {
  $.ajax({
    url: JS_URL + "ajax_agenda",
    type: "get",
    dataType: "html",
    success: function (response) {
      $("#agendaWrapper").html(response);
      show_countdown();
    },
  });
}
