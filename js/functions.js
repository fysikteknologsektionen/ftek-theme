jQuery.timeago.settings.allowFuture = true;

if (ftek_info.language == "sv-SE") {
	jQuery.timeago.settings.strings = {
	  prefixAgo: "för",
	  prefixFromNow: "om",
	  suffixAgo: "sedan",
	  suffixFromNow: "",
	  seconds: "%d s",
	  minute: "1 min",
	  minutes: "%d min",
	  hour: "en timme",
	  hours: "%d timmar",
	  day: "en dag",
	  days: "%d dagar",
	  month: "en månad",
	  months: "%d månader",
	  year: "ett år",
	  years: "%d år"
	};
}
else
{
  jQuery.timeago.settings.strings = {
    prefixAgo: null,
    prefixFromNow: "in",
    suffixAgo: "ago",
    suffixFromNow: null,
    seconds: "%d s",
    minute: "1 min",
    minutes: "%d min",
    hour: "an hour",
    hours: "%d hours",
    day: "a day",
    days: "%d days",
    month: "a month",
    months: "%d months",
    year: "a year",
    years: "%d years",
    wordSeparator: " ",
    numbers: []
  };
}

// On document finished loading

jQuery(document).ready(function($) {

  $('a[href*="//"]:not([href*="ftek.se"])').attr("target","_blank");

  $("time.relative-time").timeago();
  
  $('a[href="#"]').click(function(event) {
    event.preventDefault();
  });

  $('button.close-button').click(function(event) {
    event.preventDefault();
    $(this).parent().remove();
  });

  $('li.menu-item-has-children').click(function(event) {
    event.stopPropagation();
    if ($(this).hasClass('hovered')) {
      $(this).find('li.menu-item-has-children').removeClass('hovered');
    } else {
      $(this).siblings('li.menu-item-has-children').removeClass('hovered');
    }

    $(this).toggleClass('hovered');
  });

  $('ul.nav-menu > li:first-child').click(function(event) {
    event.stopPropagation();
    $(this).toggleClass('hovered');
});

});