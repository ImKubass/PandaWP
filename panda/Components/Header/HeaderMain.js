//Document ready
$(function() {
	headerNavButtonClick();
	headerMaskClick();
	desktopSubmenu();
	mobileSubmenuInit();
	mobileSubmenu();
	headerSearch();
	headerLang();

	//Initializations
	$(".header-main").headroom({
		offset: 0,
		onTop: function() {
			//SomeCoolFunction()
		},
		onNotTop: function() {
			//EvenCoolerFunction()
		}
	});
});

//Resize
$(window).resize(function() {
	if (window.matchMedia("(min-width: 62em)").matches) {
		$(".nav-main").removeClass("js-transition");
		headerMaskHide();
		headerNavHide();
	}

	if (window.matchMedia("(min-width: 36em)").matches) {
		if ($(".header-search-inner").hasClass("js-search-open")) {
			headerSearchClose();
			headerMaskHide();
		}
	}
});

//Header nav
function headerNavButtonClick() {
	$(".header-nav-button").click(function() {
		if (!$(".nav-main").hasClass("js-open")) {
			headerNavShow();
			headerMaskShow();
		} else {
			headerNavHide();
			headerMaskHide();
		}

		if (!$(".nav-main").hasClass("js-transition")) {
			$(".nav-main").addClass("js-transition");
		}
	});
}

function headerNavShow() {
	$(".nav-main").addClass("js-open");
	$(".header-nav-button").addClass("js-open");
	$("body,html").addClass("js-no-scroll");
}

function headerNavHide() {
	$(".nav-main").removeClass("js-open");
	$(".header-nav-button").removeClass("js-open");
	$("body,html").removeClass("js-no-scroll");

	if (window.matchMedia("(max-width: 61.938em)").matches) {
	}

	//Sub menu close
	$(".sub-menu-button").removeClass("js-open");

	$(".sub-menu-button")
		.closest(".menu-item-has-children")
		.removeClass("js-open");

	$(".sub-menu-button")
		.prev(".sub-menu")
		.find(".js-open")
		.removeClass("js-open");

	$(".nav-main")
		.find(".sub-menu")
		.slideUp(300);
}

//Header lang
function headerLang() {
	$(".header-language-current").click(function() {
		$(".header-language-list").toggleClass("js-open");
	});

	//Close
	$(document).click(function(e) {
		if (!$(".header-language-switcher *").is(e.target) && $(".header-language-list").has(e.target).length === 0) {
			$(".header-language-list").removeClass("js-open");
		}
	});
}

//Header Mask
function headerMaskClick() {
	$(".header-mask").click(function() {
		headerNavHide();
		headerMaskHide();
		i;
	});
}

function headerMaskShow() {
	$(".header-mask").addClass("js-active");
}

function headerMaskHide() {
	$(".header-mask").removeClass("js-active");
}

//Desktop submenu
function desktopSubmenu() {
	if (window.matchMedia("(min-width: 62em)").matches) {
		$(".sub-menu .menu-item-has-children").mouseover(function() {
			$(".sub-menu .sub-menu").each(function() {
				var leftOffset = $(this).offset().left;
				elWidht = $(this).width();

				if ($(window).width() <= leftOffset + elWidht + 5) {
					$(this).addClass("js-sub-menu-left");
				}
			});
		});
	}
}

//Mobile submenu init
function mobileSubmenuInit() {
	$(".menu-item-has-children").append('<span class="sub-menu-button"></span>');
}

//Mobile submenu
function mobileSubmenu() {
	$(".sub-menu-button").click(function() {
		if (!$(this).hasClass("js-open")) {
			$(this).addClass("js-open");
			$(this)
				.closest(".menu-item-has-children")
				.addClass("js-open");

			$(this)
				.prev(".sub-menu")
				.slideDown(300);
		} else {
			$(this).removeClass("js-open");

			$(this)
				.closest(".menu-item-has-children")
				.removeClass("js-open");

			$(this)
				.prev(".sub-menu")
				.find(".js-open")
				.removeClass("js-open");

			$(this)
				.prev(".sub-menu")
				.slideUp(300);

			$(this)
				.prev(".sub-menu")
				.find(".sub-menu")
				.slideUp(300);
		}
	});
}

//Header search
function headerSearch() {
	$(".header-search-button").click(function() {
		if (!$(".header-search-inner").hasClass("js-search-open")) {
			headerSearchOpen();
		} else {
			headerSearchClose();
			headerMaskHide();
		}
	});

	$(document).click(function(e) {
		if (!$(".header-search *").is(e.target) && $(".header-search-inner").has(e.target).length === 0) {
			if ($(".header-search-inner").hasClass("js-search-open")) {
				headerSearchClose();
			}
		}
	});
}

function headerSearchOpen() {
	$(".header-search-inner").addClass("js-search-open");
	$(".header-search-input").focus();

	if (window.matchMedia("(max-width: 35.938em)").matches) {
		headerMaskShow();
		$("body,html").addClass("js-no-scroll");
	}

	$(".header-search-inner").addClass("js-animate");
}

function headerSearchClose() {
	$(".header-search-inner").removeClass("js-animate");

	$(".header-search-inner").removeClass("js-search-open");
	$(".header-search-input").val("");
	$("body,html").removeClass("js-no-scroll");
}
