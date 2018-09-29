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

  // Remove attr to only style by CSS
  $('article img').removeAttr('width').removeAttr('height');

  // Remove external links styling from images with links
  $('a[target="_blank"] img').parent().addClass("no-external");

  $('a[href^="mailto:"]').attr("target","_blank").attr("rel","noopener");

  $("time.relative-time").timeago();

  if ($('#wpadminbar').length > 0) {
    $('ul.nav-menu > li > ul.sub-menu').css('top', 'calc(6rem + '+$('#wpadminbar').height()+'px)');
    $('.extra-nav').css('top', 32);
  }

  if ($('#wp-calendar').length > 0) {
    let $title = $('#wp-calendar').parent().parent().find('.widget-title').eq(0);
    $title.html('<a href="/kalender">'+$title.html()+'</a>');
  }

  if ($('.wppsac-slick-slider-wrp').length > 0) {
    let $title = $('.wppsac-slick-slider-wrp').parent().parent().find('.widget-title').eq(0);
    $title.html('<a href="/nyheter">'+$title.html()+'</a>');
  }

  $('a[href="#allCategoriesList#"]').removeAttr('href');

  $('button.close-button').click(function(event) {
    event.preventDefault();
    $(this).parent().remove();
  });

  $('ul.nav-menu > li:first-child').after('<li class="menu-more-button"><a></a></li>');

  $('ul.nav-menu > li.menu-item-has-children').click(function(event) {
    if ($(event.target.parentElement.parentElement).hasClass('nav-menu')) {
      event.stopPropagation();
      positionMenus();
      if ($(this).children('a[href]').length === 0) {
        if ($(this).hasClass('hovered')) {
          $(this).find('li.menu-item-has-children').removeClass('hovered');
        } else {
          $(this).siblings('li.menu-item-has-children').removeClass('hovered');
        }

        $(this).toggleClass('hovered');
      }
    }
  });

  $('ul.nav-menu > li.menu-item-has-children > a.menu-dropdown-button').click(function(event) {
    event.stopPropagation();
    positionMenus();
    if ($(this).parent().hasClass('hovered')) {
      $(this).parent().find('li.menu-item-has-children').removeClass('hovered');
    } else {
      toggleDropdownMenu($('ul.nav-menu > li.menu-more-button'), $('.extra-nav'), true);
      $(this).parent().siblings('li.menu-item-has-children').removeClass('hovered');
    }

    $(this).parent().toggleClass('hovered');
  });

  $('ul.nav-menu > li.menu-more-button').click(function(event) {
    event.stopPropagation();
    toggleDropdownMenu($(this), $('.extra-nav'), null);
  });

  if (ftek_info.language === 'sv-SE') {
    $(".recent-post-slider .readmorebtn").text("Läs mer");
  }

});

function toggleDropdownMenu($moreButton, $extraNav, show){
  if (show) {
    $moreButton.addClass('hovered');
    $extraNav.addClass('hovered');
  } else {
    $moreButton.toggleClass('hovered');
    $extraNav.toggleClass('hovered');
  }
}

function positionMenus() {
  if (screen.width > 960) {
    jQuery('ul.nav-menu > li.menu-item-has-children').each(function(){
      let liXPos = jQuery(this).offset().left;
      let liWidth = jQuery(this).width();

      let subMenu = jQuery(this).children('ul.sub-menu');
      let ulWidth = subMenu.width();

      if (ulWidth < liWidth) {
        ulWidth = liWidth;
        subMenu.css('min-width', ulWidth+'px');
      }

      subMenu.css('transform', 'translateX('+(liWidth/2 - ulWidth/2)+ 'px)');
    });
  }
}