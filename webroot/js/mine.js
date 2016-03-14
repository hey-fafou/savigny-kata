$(document).ready(function() {
  $(".nav-button").click(function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    } else {
      $(this).addClass("active");
    }
  });

  $(".nav-link").attr('class', function() {
    if (Date().substring(0,3) == "Mon") {
      $(this).addClass("violet");
    } else if (Date().substring(0,3) == "Tue") {
      $(this).addClass("indigo");
    } else if (Date().substring(0,3) == "Wed") {
      $(this).addClass("blue");
    } else if (Date().substring(0,3) == "Thu") {
      $(this).addClass("green");
    } else if (Date().substring(0,3) == "Fri") {
      $(this).addClass("yellow");
    } else if (Date().substring(0,3) == "Sat") {
      $(this).addClass("orange");
    } else if (Date().substring(0,3) == "Sun") {
      $(this).addClass("red");
    }
  });
});
