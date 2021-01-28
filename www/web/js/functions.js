/*global jQuery:false */
/*global testData:false */
/*global Modernizr:false */

//###########################
// TINY NAV
//###########################
jQuery(function () {
"use strict";
  // TinyNav.js 1
  jQuery('.menu').tinyNav({
	active: 'selected'
  });
  
});





// ##############################
// FADE APEARING HOMEPAGE BOXES
// ##############################
jQuery(document).ready(function(){
"use strict";
jQuery("div.square1").addClass("invizible");
jQuery("div.square2").addClass("invizible");
jQuery("div.square3").addClass("invizible");
jQuery("div.square4").addClass("invizible");
jQuery("div.square5").addClass("invizible");
jQuery("div.square6").addClass("invizible");
jQuery("div.row1").addClass("invizible");
jQuery("div.row2").addClass("invizible");



setTimeout(function(){
jQuery("div.square1").fadeIn("slow");
}, 1700);

setTimeout(function(){
jQuery("div.square2").fadeIn("slow");
}, 1800);

setTimeout(function(){
jQuery("div.square3").fadeIn("slow");
}, 1900);

setTimeout(function(){
jQuery("div.square4").fadeIn("slow");
}, 2000);

setTimeout(function(){
jQuery("div.square5").fadeIn("slow");
}, 2100);

setTimeout(function(){
jQuery("div.square6").fadeIn("slow");
}, 2200);

setTimeout(function(){
jQuery("div.row1").fadeIn("slow");
}, 2300);

setTimeout(function(){
jQuery("div.row2").fadeIn("slow");
}, 2400);
  

  
/*#################*/
/*THEME.html Custom buttons*/
/*#################*/
	
jQuery(window).load(function(){
jQuery("div.titanictitlewp").addClass("invizible"); 
jQuery("div.titanictitlehtml").addClass("invizible");
jQuery("div.titanictitlepsd").addClass("invizible");
jQuery("div.titanictitlejm").addClass("vizible");

jQuery("a").on("click", function () {

var jQuerythis = jQuery(this);
if ( jQuerythis.hasClass('joomla') ) {
	jQuery("div.titanictabs>ul>li.on").removeClass("on");
	jQuery(this).closest('li').addClass("on");
	jQuery("div.categoriesmodule>ul>li.selected").removeClass("selected");

	jQuery("div.titanictitlewp").removeClass("invizible vizible");
	jQuery("div.titanictitlehtml").removeClass("invizible vizible");
	jQuery("div.titanictitlejm").removeClass("invizible vizible");
	jQuery("div.titanictitlepsd").removeClass("invizible vizible");

	jQuery("div.titanictitlewp").addClass("invizible"); 
	jQuery("div.titanictitlehtml").addClass("invizible");
	jQuery("div.titanictitlepsd").addClass("invizible");
	jQuery("div.titanictitlejm").addClass("vizible");
	return;
  }
if ( jQuerythis.hasClass('wordpress') ) {
	jQuery("div.titanictabs>ul>li.on").removeClass("on");
	jQuery(this).closest('li').addClass("on");

	jQuery("div.titanictitlewp").removeClass("invizible vizible");
	jQuery("div.titanictitlehtml").removeClass("invizible vizible");
	jQuery("div.titanictitlejm").removeClass("invizible vizible");
	jQuery("div.titanictitlepsd").removeClass("invizible vizible");

	jQuery("div.titanictitlehtml").addClass("invizible");  
	jQuery("div.titanictitlepsd").addClass("invizible");
	jQuery("div.titanictitlejm").addClass("invizible");
	jQuery("div.titanictitlewp").addClass("vizible");
	return;
  }
 if ( jQuerythis.hasClass('html') ) {
	jQuery("div.titanictabs>ul>li.on").removeClass("on");
	jQuery(this).closest('li').addClass("on");
	
	jQuery("div.titanictitlewp").removeClass("invizible vizible");
	jQuery("div.titanictitlehtml").removeClass("invizible vizible");
	jQuery("div.titanictitlejm").removeClass("invizible vizible");
	jQuery("div.titanictitlepsd").removeClass("invizible vizible");
 
	jQuery("div.titanictitlepsd").addClass("invizible");
	jQuery("div.titanictitlejm").addClass("invizible");
	jQuery("div.titanictitlewp").addClass("invizible");
	jQuery("div.titanictitlehtml").addClass("vizible");
	return;
  }
if ( jQuerythis.hasClass('psd') ) {
	jQuery("div.titanictabs>ul>li.on").removeClass("on");
	jQuery(this).closest('li').addClass("on");

	jQuery("div.titanictitlewp").removeClass("invizible vizible");
	jQuery("div.titanictitlehtml").removeClass("invizible vizible");
	jQuery("div.titanictitlejm").removeClass("invizible vizible");
	jQuery("div.titanictitlepsd").removeClass("invizible vizible");


	jQuery("div.titanictitlewp").addClass("invizible");
	jQuery("div.titanictitlehtml").addClass("invizible");
	jQuery("div.titanictitlejm").addClass("invizible");		
	jQuery("div.titanictitlepsd").addClass("vizible");

	return;
  }


});

});
  
  
  
  
  
  
  
  
  
  
  

/*#################*/
/*FOR LIGHT VERSION*/
/*#################*/

jQuery("div.light_square1").addClass("invizible");
jQuery("div.light_square2").addClass("invizible");
jQuery("div.light_square3").addClass("invizible");
jQuery("div.light_square4").addClass("invizible");
jQuery("div.light_square5").addClass("invizible");
jQuery("div.light_square6").addClass("invizible");
 
setTimeout(function(){
	jQuery("div.light_square1").fadeIn("slow");
}, 1700);

 setTimeout(function(){
	jQuery("div.light_square2").fadeIn("slow");
}, 1800);

 setTimeout(function(){
	jQuery("div.light_square3").fadeIn("slow");
}, 1900);

  setTimeout(function(){
	jQuery("div.light_square4").fadeIn("slow");
}, 2000);

  setTimeout(function(){
	jQuery("div.light_square5").fadeIn("slow");
}, 2100);

  setTimeout(function(){
	jQuery("div.light_square6").fadeIn("slow");
}, 2200);
  
  
  
  
 });






// ##############################
// ROLLOVERS WITH FADE IE7+
// ##############################
jQuery(document).ready(function(){
"use strict";
jQuery("div.square1").hover(
  function(){
	jQuery(this).find("div.square1Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.square1Rollover").fadeOut(400);
  }
);



jQuery("div.square2").hover(
  function(){
	jQuery(this).find("div.square2Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.square2Rollover").fadeOut(400);
  }
);


jQuery("div.square3").hover(
  function(){
	jQuery(this).find("div.square3Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.square3Rollover").fadeOut(400);
  }
);


jQuery("div.square4").hover(
  function(){
	jQuery(this).find("div.square4Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.square4Rollover").fadeOut(400);
  }
);

jQuery("div.square5").hover(
  function(){
	jQuery(this).find("div.square5Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.square5Rollover").fadeOut(400);
  }
);


jQuery("div.square6").hover(
  function(){
	jQuery(this).find("div.square6Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.square6Rollover").fadeOut(400);
  }
);



jQuery("div.thumb").hover(
  function(){
	jQuery(this).find("div.thumbRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.thumbRollover").fadeOut(400);
  }
);


jQuery("div.footerlogo").hover(
  function(){
	jQuery(this).find("div.footerlogoRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.footerlogoRollover").fadeOut(400);
  }
);
	
	
	
/*#################*/
/*FOR LIGHT VERSION*/
/*#################*/

jQuery("div.light_square1").hover(
  function(){
	jQuery(this).find("div.light_square1Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.light_square1Rollover").fadeOut(400);
  }
);



jQuery("div.light_square2").hover(
  function(){
	jQuery(this).find("div.light_square2Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.light_square2Rollover").fadeOut(400);
  }
);


jQuery("div.light_square3").hover(
  function(){
	jQuery(this).find("div.light_square3Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.light_square3Rollover").fadeOut(400);
  }
);


jQuery("div.light_square4").hover(
  function(){
	jQuery(this).find("div.light_square4Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.light_square4Rollover").fadeOut(400);
  }
);

jQuery("div.light_square5").hover(
  function(){
	jQuery(this).find("div.light_square5Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.light_square5Rollover").fadeOut(400);
  }
);


jQuery("div.light_square6").hover(
  function(){
	jQuery(this).find("div.light_square6Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.light_square6Rollover").fadeOut(400);
  }
);


	
	jQuery("div.bigblogpicture").hover(
  function(){
	jQuery(this).find("div.bigblogpictureRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.bigblogpictureRollover").fadeOut(400);
  }
);


	jQuery("div.blogpicture").hover(
  function(){
	jQuery(this).find("div.blogpictureRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.blogpictureRollover").fadeOut(400);
  }
);



	jQuery("div.smallblogpicture").hover(
  function(){
	jQuery(this).find("div.smallblogpictureRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.smallblogpictureRollover").fadeOut(400);
  }
);	



	jQuery("div.isoani").hover(
  function(){
	jQuery(this).find("div.isoaniRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.isoaniRollover").fadeOut(400);
  }
);



jQuery("div.team").hover(
  function(){
	jQuery(this).find("div.teamRollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.teamRollover").fadeOut(400);
  }
);

	jQuery("div.team1").hover(
  function(){
	jQuery(this).find("div.team1Rollover").fadeIn(400);
  },
  function(){
	jQuery(this).find("div.team1Rollover").fadeOut(400);
  }
);






	
}); 




// ##############################
// INITIALIZE SEARCH AUTOCOMPLETE
// ##############################
function callback(item) {
"use strict";
	/* #Activate link#*/
	window.location = item.url;
	
}
jQuery(function() {
"use strict";
	jQuery('input#suggestBox2').jsonSuggest({data: testData.webSites, onSelect: callback});
});











//###########################			
/*QUOTES - FADE IN FADE OUT */	
//###########################

jQuery(document).ready(function(){
"use strict";
	jQuery('#fade').list_ticker({
		speed:12000,
		effect:'fade'
	});
	jQuery('#slide').list_ticker({
		speed:12000,
		effect:'slide'
	});		
});
			
			
//###########################			
/*INITIALIZE TIPSY TOOLTIP*/	
//###########################

jQuery(function() {
"use strict";
jQuery('#example-1').tipsy();

jQuery('#auto-gravity').tipsy({gravity: jQuery.fn.tipsy.autoNS});

jQuery('#example-fade').tipsy({fade: true});
jQuery('#example-fade2').tipsy({fade: true});
jQuery('#example-fade3').tipsy({fade: true});
jQuery('#example-fade4').tipsy({fade: true});
jQuery('#example-fade5').tipsy({fade: true});

jQuery('#example-custom-attribute').tipsy({title: 'id'});
jQuery('#example-callback').tipsy({title: function() { return this.getAttribute('original-title').toUpperCase(); } });
jQuery('#example-fallback').tipsy({fallback: "Where's my tooltip yo'?" });

jQuery('#example-html').tipsy({html: true });

});
  
  
  
// #######################
/*SOCIAL MEDIA FADE IE7+*/
// #######################		
			
jQuery(function() {
"use strict";

	jQuery(".facebook")
	.find("span")
	.hide()
	.end()
	.hover(function() {
		jQuery(this).find("span").stop(true, true).fadeIn();
	}, function() {
		jQuery(this).find("span").stop(true, true).fadeOut();
	});
	
	jQuery(".twitter")
	.find("span")
	.hide()
	.end()
	.hover(function() {
		jQuery(this).find("span").stop(true, true).fadeIn();
	}, function() {
		jQuery(this).find("span").stop(true, true).fadeOut();
	});
	
	jQuery(".gplus")
	.find("span")
	.hide()
	.end()
	.hover(function() {
		jQuery(this).find("span").stop(true, true).fadeIn();
	}, function() {
		jQuery(this).find("span").stop(true, true).fadeOut();
	});
	
	jQuery(".dribbble")
	.find("span")
	.hide()
	.end()
	.hover(function() {
		jQuery(this).find("span").stop(true, true).fadeIn();
	}, function() {
		jQuery(this).find("span").stop(true, true).fadeOut();
	});
	
	
	jQuery(".youtube")
	.find("span")
	.hide()
	.end()
	.hover(function() {
		jQuery(this).find("span").stop(true, true).fadeIn();
	}, function() {
		jQuery(this).find("span").stop(true, true).fadeOut();
	});
	
});




// ########################
// BACK TO TOP FUNCTION
// ########################


jQuery(document).ready(function(){
"use strict";
	// hide #back-top first
	jQuery("#back-top").hide();
	
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 700) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 500);
			return false;
		});
		
				// scroll body to 0px on click
		jQuery('#goto a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 600
			}, 500);
			return false;
		});
		
		
		jQuery(".scroll").click(function(event){		
			event.preventDefault();
			jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top}, 500);
		});
		
		
		
		
		
	});
	
	
	
		//conditions to change buttons to active on single page website (index_spw.html)
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() <= 2900) {
				jQuery(".chome").addClass("sactive");
			} else {
				jQuery(".chome").removeClass("sactive");
			}
			
			if (jQuery(this).scrollTop() >= 2901 && jQuery(this).scrollTop() <= 4300) {
				jQuery(".cabout").addClass("sactive");
			} else {
				jQuery(".cabout").removeClass("sactive");
			}
			
			if (jQuery(this).scrollTop() >= 4301 && jQuery(this).scrollTop() <= 5400) {
				jQuery(".cportfolio").addClass("sactive");
			} else {
				jQuery(".cportfolio").removeClass("sactive");
			}
			
			if (jQuery(this).scrollTop() >= 5501 && jQuery(this).scrollTop() <= 6600) {
				jQuery(".cpricelist").addClass("sactive");
			} else {
				jQuery(".cpricelist").removeClass("sactive");
			}
			
			if (jQuery(this).scrollTop() >= 6601 && jQuery(this).scrollTop() <= 7600) {
				jQuery(".ccontact").addClass("sactive");
			} else {
				jQuery(".ccontact").removeClass("sactive");
			}
			
			
		});
	});
	
	
	

});


// ########################
// Accordion MENU
// ########################


jQuery(document).ready(function() {
"use strict";
	// Store variables
	
	var accordion_head = jQuery('.accordion > li > a'),
		accordion_body = jQuery('.accordion li > .sub-menu');

	// Open the first tab on load
	//accordion_head.first().addClass('active').next().slideDown('normal');
	
	// Open the second tab on load
	accordion_head.eq(1).addClass('active').next().slideDown('normal');

	// Click function

	accordion_head.on('click', function(event) {

		// Disable header links
		
		event.preventDefault();

		// Show and hide the tabs on click

		if (jQuery(this).attr('class') !== 'active'){
			accordion_body.slideUp('normal');
			jQuery(this).next().stop(true,true).slideToggle('normal');
			accordion_head.removeClass('active');
			jQuery(this).addClass('active');
		}

	});

});



// ########################
// ACTIVATE TWEET
// ########################

jQuery(function($){
"use strict";
	$(".tweet").tweet({
		username: "dajy",
		join_text: "auto",
		avatar_size: 35,
		count: 3,
		auto_join_text_default: "we said,",
		auto_join_text_ed: "we",
		auto_join_text_ing: "we were",
		auto_join_text_reply: "we replied to",
		auto_join_text_url: "we were checking out",
		loading_text: "Loading tweets...",
		refresh_interval: 60
	}).bind("loaded",function(){$(this).find("a").attr("target","_blank");});
  });
  
  
// ########################
// INITIALIZE FRED CAROUSEL
// ########################  
  
jQuery(function() {
"use strict";
	//	Fuild layout, centering the items
		jQuery('#foo6').carouFredSel({
		auto: true,
		responsive: true,
		prev: '#prev6',
		next: '#next6',
		pagination: "#pager6",
		swipe: true,
		mousewheel: true,
		width: '100%',
		scroll: 1,
		items: {
		width: 200,
		//	height: '30%',	//	optionally resize item-height
		visible: {
				min: 1,
				max: 5
			}
		}
	
	});
	
	
	//	Fuild layout, centering the items
		jQuery('#foo7').carouFredSel({
		auto: true,
		responsive: true,
		prev: {
			button: "#prev7",
			key: "left"
		},
		next: {
			button: "#next7",
			key: "right"
		},
		pagination: "#pager7",
		swipe: true,
		mousewheel: true,
		width: '100%',
		scroll: 1,
		items: {
		width: 300,
		//	height: '30%',	//	optionally resize item-height
		visible: {
				min: 1,
				max: 4
			}
		}
	
	});

});
  
  
  
// ########################
// MODERNIZR TRANSITIONS
// ########################  
if (!Modernizr.csstransitions) {
jQuery(document).ready(function(){
"use strict";
jQuery(".btn1").hover(function () {
	jQuery(this).stop().animate({ color: "#ffffff", backgroundColor:"#000000", border:"#cccccc" },500);
 }, function() {
	jQuery(this).stop().animate({ color: "#000000", backgroundColor:"#ffffff", border:"#333333" },500);}	 
 );
 
jQuery(".flink").hover(function () {
	jQuery(this).stop().animate({ color: "#ffffff", marginLeft:"5px"},500);
 }, function() {
	jQuery(this).stop().animate({ color: "#666666", marginLeft:"0px"},500);}	 
 );
 
jQuery(".flink2").hover(function () {
	jQuery(this).stop().animate({ color: "#ffffff"},500);
 }, function() {
	jQuery(this).stop().animate({ color: "#666666"},500);}	 
 );
 
 

});
}











