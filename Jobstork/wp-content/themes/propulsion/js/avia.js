/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += 'js_active';
/*end dom flickering =) */

//global path: avia_framework_globals.installedAt

jQuery.noConflict();
jQuery(document).ready(function(){
	
	
	//activates the slideshow
	if(jQuery.fn.adaptavia)	
	jQuery('.adaptavia').adaptavia();
	
	if(jQuery.fn.avia_base_slider)
	{	
		jQuery('.fade_slider').avia_base_slider({transition:'fade'});
		jQuery('.move_slider').avia_base_slider();
		jQuery('.slideshow').avia_base_control_hide();
		jQuery('.slideshow').avia_external_controls();
	}
	

	//activates the mega menu javascript
	if(jQuery.fn.aviaMegamenu)		
	jQuery(".main_menu .avia_mega, .sub_menu>ul, .sub_menu>div>ul").aviaMegamenu({modify_position:true});

	//activates the prettyphoto lightbox
	if(jQuery.fn.avia_activate_lightbox)		
	jQuery('body').avia_activate_lightbox();
	
	//activates the hover effect for image links
	if(jQuery.fn.avia_activate_hover_effect)
	jQuery('body').avia_activate_hover_effect();

	
	// enhances contact form with ajax capabilities
	if(jQuery.fn.kriesi_ajax_form)
	jQuery('.ajax_form').kriesi_ajax_form();
	
	//smooth scrooling
	if(jQuery.fn.avia_smoothscroll)
	jQuery('a[href*=#]').avia_smoothscroll();
	
	//activates the shortcode content slider
	if(jQuery.fn.avia_sc_slider)
	{								
		jQuery(".content_slider").avia_sc_slider({appendControlls:{}});
		jQuery(".shop_slider_yes ul").avia_sc_slider({appendControlls:false, group:true, slide:'.product', arrowControll: true, autorotationInterval:'parent'});
	}
	//activates the toggle shortcode
	if(jQuery.fn.avia_sc_toggle)
	jQuery('.togglecontainer').avia_sc_toggle();
	
	//activates the tabs shortcode
	if(jQuery.fn.avia_sc_tabs)
	jQuery('.tabcontainer').avia_sc_tabs();
	
	//activate html5 flare video player
	if(jQuery.fn.avia_video_activation)
	jQuery(".avia_video").avia_video_activation({ratio:'16:9'});
	
	//activates the mega menu javascript
	if(jQuery.fn.avia_menu_helper)		
	jQuery(".main_menu .menu").avia_menu_helper({modify_position:true});
	
	
	//activate html5 flare video player
	if(jQuery.fn.avia_hide_info_text)
	jQuery("#info_text_header").avia_hide_info_text();


	
	// actiavte portfolio sorting
	if(jQuery.fn.avia_iso_sort)
	jQuery('.portfolio-sort-container').avia_iso_sort();
	
	jQuery(window).resize(avia_menu_align).trigger('resize');
	avia_ie_fix();
	avia_more_link_fade('.template-portfolio-overview:not(.portfolio-size-1)');
	
	
	// improves comment forms
	if(jQuery.fn.kriesi_empty_input)
	jQuery('#s, #search-fail input').kriesi_empty_input();
	
	
	// improves menu for mobile devices
	jQuery('.main_menu ul:eq(0)').mobileMenu({
	  switchWidth: 768,                   							//width (in px to switch at)
	  topOptionText: jQuery('.main_menu').data('selectname'),     	//first option text
	  indentString: '&nbsp;&nbsp;&nbsp;'  							//string for indenting nested items
	});
});




function avia_more_link_fade(container)
{
	var container 	= jQuery(container),
		links 		= container.find('.more-link').css({opacity:0, 'visibility':'visible'}),
		parents 	= links.parents('.post-entry');
		parents.hover(
			function()
			{
				jQuery(this).find('.more-link').stop().animate({opacity:1});
			}, 
			function()
			{
				jQuery(this).find('.more-link').stop().animate({opacity:0});
			}
		);
}

function avia_menu_align()
{
	var menu = jQuery('.main_menu'),
		logo = jQuery('.logo'),
		container = menu.parent('.container');
		
		if(container.width() > logo.outerWidth() + menu.outerWidth())
		{
			menu.css({float:"right"});
		}
		else
		{
			menu.css({float:"left"});
		}
}

function avia_ie_fix()
{
	if(!jQuery.support.opacity)
	{
		jQuery('.image_overlay_effect').css({'background-image':'none'});
	}

}


// -------------------------------------------------------------------------------------------
// Mega Menu
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.aviaMegamenu = function(variables) 
	{
		var defaults = 
		{
			modify_position:true,
			delay:300
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var menu = $(this),
				menuItems = menu.find(">li"),
				megaItems = menuItems.find(">div").parent().css({overflow:'hidden'}),
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainerWidth = menu.parent().width(),
				delayCheck = {};

			
			menuItems.each(function()
			{
				var item = $(this),
					pos = item.position(),
					megaDiv = item.find("div:first").css({opacity:0, display:"none"}),
					normalDropdown = "";
				
				//check if we got a mega menu	
				if(!megaDiv.length)
				{
					normalDropdown = item.find(">ul").css({display:"none"});
				}
				
				//if we got a mega menu or dropdown menu add the arrow beside the menu item	
				if(megaDiv.length || normalDropdown.length)
				{
					var link = item.addClass('dropdown_ul_available').find('>a');
					link.html("<span class='dropdown_link'>"+link.html()+"</span>").append('<span class="dropdown_available"></span>');

					//is a mega menu main item doesnt have a link to click use the default cursor
					if(typeof link.attr('href') != 'string'){ link.css('cursor','default'); }
				}
				
				//correct position of mega menus			
				if(options.modify_position && megaDiv.length)
				{										
					if(megaDiv.width() > pos.left)
					{
						megaDiv.css({left: (pos.left* -1)});
						//megaDiv.css({left: (Math.ceil() * -1)});
					}
					else if(pos.left + megaDiv.width() > parentContainerWidth)
					{
						megaDiv.css({left: (megaDiv.width() - pos.left) * -1 });
					}
				}
				
			});	
				
			
			function megaDivShow(i)
			{
				if(delayCheck[i] == true)
				{
					var item = megaItems.filter(':eq('+i+')').css({overflow:'visible'}).find("div:first"),
						link = megaItems.filter(':eq('+i+')').find("a:first");
						
						
						item.stop().css('display','block').animate({opacity:1},300);
						
						if(item.length)
						{
							link.addClass('open-mega-a');
						}
				}
			}
			
			function megaDivHide (i)
			{
				if(delayCheck[i] == false)
				{
					megaItems.filter(':eq('+i+')').find(">a").removeClass('open-mega-a');
					
					var listItem = megaItems.filter(':eq('+i+')'),
						item = listItem.find("div:first");
					
						
					item.stop().css('display','block').animate({opacity:0},300, function()
					{
						$(this).css('display','none');
						listItem.css({overflow:'hidden'});
					});
				}
			}


			//bind event for mega menu
			megaItems.each(function(i){
			
				$(this).hover(
				
					function()
					{	
						delayCheck[i] = true;
						setTimeout(function(){megaDivShow(i); },options.delay);
					},
					
					function()
					{
						delayCheck[i] = false;
						setTimeout(function(){megaDivHide(i); },options.delay);					
					}
				);
			});
			
			
			// bind events for dropdown menu
			dropdownItems.find('li').andSelf().each(function()
			{	
				var currentItem = $(this),
					sublist = currentItem.find('ul:first'),
					showList = false;
				
				if(sublist.length) 
				{ 
					sublist.css({display:'block', opacity:0, visibility:'hidden'}); 
					var currentLink = currentItem.find('>a');
					
					currentLink.bind('mouseenter', function()
					{
						sublist.stop().css({visibility:'visible'}).animate({opacity:1});
					});
					
					currentItem.bind('mouseleave', function()
					{
						sublist.stop().animate({opacity:0}, function()
						{
							sublist.css({visibility:'hidden'});
						});
					});

				}
		
			});
			
		});
	};
})(jQuery);	







(function($)
{
	$.fn.avia_iso_sort = function(options) 
	{
	
		$.extend( $.Isotope.prototype, {
		  _customModeReset : function() { 
		  
		  	this.fitRows = {
		        x : 0,
		        y : 0,
		        height : 0
		      };
		  
		   },
		  _customModeLayout : function( $elems ) { 
		  
		    var instance 		= this,
		        containerWidth 	= this.element.width(),
		        props 			= this.fitRows,
		        margin 			= (containerWidth / 100) * 4, //margin based on %
		        extraRange		= 2; // adds a little range for % based calculation error in some browsers
      
		      $elems.each( function() {
		        var $this = $(this),
		            atomW = $this.outerWidth(),
		            atomH = $this.outerHeight(true);
		      	
		        if ( props.x !== 0 && atomW + props.x > containerWidth + extraRange ) {
		          // if this element cannot fit in the current row
		          props.x = 0;
		          props.y = props.height;
		        } 
		     	
		     	//webkit gets blurry elements if position is a float value
		     	props.x = Math.round(props.x);
		     	props.y = Math.round(props.y);
		     
		        // position the atom
		        instance._pushPosition( $this, props.x, props.y );
		  		
		        props.height = Math.max( props.y + atomH, props.height );
		        props.x += atomW + margin;
		  	
		  	
		      });
		  
		  },
		  _customModeGetContainerSize : function() { 
		  
		  	return { height : this.fitRows.height };
		  
		  },
		  _customModeResizeChanged : function() { 
		  
		  	return true;
		  	
		   }
		});
	
	
		return this.each(function()
		{	
			
			var container 	= $(this),
				filter		= container.prev('#js_sort_items').css({visibility:"visible", opacity:0}),
				links 		= filter.find('a'),
				isoActive 	= false,
				items		= $('.post-entry', container);
				
			function applyIso()
			{
				container.isotope({ 
					layoutMode : 'customMode', itemSelector : '.flex_column' 
				});
				
				isoActive = true;
			};
			
			links.bind('click',function()
			{	
				var current 	= $(this),
			  		selector 	= current.data('filter');
					links.removeClass('active_sort');
					current.addClass('active_sort');
					
					container.isotope({ layoutMode : 'customMode', itemSelector : '.flex_column' , filter: '.'+selector});
					
					return false;
			});
			
			// update columnWidth on window resize
			$(window).smartresize(function()
			{
			  	applyIso();
			});
			
			
			$(window).bind('avia_images_loaded', function()
			{
				setTimeout(function(){
				
					filter.animate({opacity:1});
					applyIso();
				
				}, 500);
			});
			///applyIso();
		});
	};
})(jQuery);		
// -------------------------------------------------------------------------------------------
// input field improvements
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.kriesi_empty_input = function(options) 
	{	
		return this.each(function()
		{	
			var currentField = $(this);
			currentField.methods = 
			{
				startingValue:  currentField.val(),
				
				resetValue: function()
				{	
					var currentValue = currentField.val();
					if(currentField.methods.startingValue == currentValue) currentField.val('');
				},
				
				restoreValue: function()
				{	
					var currentValue = currentField.val();
					if(currentValue == '') currentField.val(currentField.methods.startingValue);
				}
			};
			
			currentField.bind('focus',currentField.methods.resetValue);
			currentField.bind('blur',currentField.methods.restoreValue);
		});
	};
})(jQuery);	

// -------------------------------------------------------------------------------------------
// Avia Menu
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.avia_menu_helper = function(variables) 
	{
		var defaults = 
		{
			modify_position:true,
			delay:300
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			
			var menu = $(this),
				menuItems = menu.find(">li"),
				dropdownItems = menuItems.find(">ul").parent(),
				parentContainerWidth = menu.parent().width(),
				delayCheck = {},
				descriptions = menu.find('.main-menu-description');

			if(!descriptions.length) menu.addClass('no_description_menu');
				
			menuItems.each(function()
			{
				var item = $(this),
					normalDropdown = item.find("li>ul").css({display:"none"});
				
				//if we got a mega menu or dropdown menu add the arrow beside the menu item	
				if(normalDropdown.length)
				{
					normalDropdown.parent('li').addClass('submenu_available');
				}
			});

			
			// bind events for dropdown menu
			dropdownItems.find('li').andSelf().each(function()
			{	
				var currentItem = $(this),
					sublist = currentItem.find('ul:first'),
					showList = false;
				
				if(sublist.length) 
				{ 
					sublist.css({display:'block', opacity:0, visibility:'hidden'}); 
					var currentLink = currentItem.find('>a');
					
					currentLink.bind('mouseenter', function()
					{
						sublist.stop().css({visibility:'visible'}).animate({opacity:1});
					});
					
					currentItem.bind('mouseleave', function()
					{
						sublist.stop().animate({opacity:0}, function()
						{
							sublist.css({visibility:'hidden'});
						});
					});

				}
		
			});
			
		});
	};
})(jQuery);	




// -------------------------------------------------------------------------------------------
// HTML 5 // Flash self hosted video
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_video_activation = function(options) 
	{
		var defaults = 
		{
			ratio: '16:9'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var fv = $(this),
		      	fv_parent = fv.parents('.slideshow:eq(0)'),
		      	fv_height = fv_parent.height(),
		      	fv_width = fv_parent.width();
		      	
		      	
		    var id_to_apply = '#' + $(this).attr('id'),
		      	posterImg = fv.attr('poster');
		      		
		    fv.height(fv_height);
		    fv.width(fv_width);
		    
		    		    
		     projekktor(id_to_apply, {
				 plugins: ['Startbutton', 'Controlbar', 'Bufferingicon'],
				 debug: false, //'console',
				 controls: true,
				 playerFlashMP4: avia_framework_globals.installedAt + 'js/projekktor/jarisplayer.swf',
				 height: fv_height,
				 width: fv_width,
				 poster: posterImg
			});

		});
	};
})(jQuery);
//.ppfsenter, .ppfsexit


// -------------------------------------------------------------------------------------------
// Tab shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_sc_tabs= function(options) 
	{
		var defaults = 
		{
			heading: '.tab',
			content:'.tab_content'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var container = $(this),
				tabs = $(options.heading, container),
				content = $(options.content, container),
				initialOpen = 1;
			
			// sort tabs
			
			if(tabs.length < 2) return;
			
			if(container.is('.tab_initial_open'))
			{
				var myRegexp = /tab_initial_open__(\d+)/;
				var match = myRegexp.exec(container[0].className);
				
				if(match != null && parseInt(match[1]) > 0)
				{
					initialOpen = parseInt(match[1]);
				}
			}
			
			if(!initialOpen || initialOpen > tabs.length) initialOpen = 1;
			
			tabs.prependTo(container).each(function(i)
			{
				var tab = $(this);
				
				//set default tab to open
					if(initialOpen == (i+1))
					{
						tab.addClass('active_tab');
						content.filter(':eq('+i+')').addClass('active_tab_content');
					}
			
				tab.bind('click', function()
				{
					if(!tab.is('.active_tab'))
					{
						$('.active_tab', container).removeClass('active_tab');
						$('.active_tab_content', container).removeClass('active_tab_content');
						
						tab.addClass('active_tab');
						content.filter(':eq('+i+')').addClass('active_tab_content');
					}
					return false;
				});
			});
		
		});
	};
})(jQuery);


// -------------------------------------------------------------------------------------------
// Toggle shortcode javascript
// -------------------------------------------------------------------------------------------
(function($)
{
	$.fn.avia_sc_toggle = function(options) 
	{
		var defaults = 
		{
			heading: '.toggler',
			content: '.toggle_wrap'
		};
		
		var options = $.extend(defaults, options);
	
		return this.each(function()
		{
			var container = $(this),
				heading   = $(options.heading, container),
				allContent = $(options.content, container),
				initialOpen = '';
			
			//check if the container has the class toggle initial open. 
			// if thats the case extract the number from the following class and open that toggle	
			if(container.is('.toggle_initial_open'))
			{
				var myRegexp = /toggle_initial_open__(\d+)/;
				var match = myRegexp.exec(container[0].className);
				
				if(match != null && parseInt(match[1]) > 0)
				{
					initialOpen = parseInt(match[1]);
				}
			}	
			
			heading.each(function(i)
			{
				var thisheading =  $(this),
					content = thisheading.next(options.content, container);
				
				if(initialOpen == (i+1)) { content.css({display:'block'}); }
				
					
				if(content.is(':visible'))
				{
					thisheading.addClass('activeTitle');
				}
				
				thisheading.bind('click', function()
				{	
					if(content.is(':visible'))
					{
						content.slideUp(300);
						thisheading.removeClass('activeTitle');
					}
					else
					{
						if(container.is('.toggle_close_all'))
						{
							allContent.slideUp(300);
							heading.removeClass('activeTitle');
						}
						content.slideDown(300);
						thisheading.addClass('activeTitle');
					}
				});
			});
		});
	};
})(jQuery); 




// -------------------------------------------------------------------------------------------
// Smooth scrooling when clicking on anchor links
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_smoothscroll = function(variables) 
	{
		return this.each(function()
		{
			$(this).click(function() {
		
			   var newHash=this.hash;
			   
			   if(newHash != '' && newHash != '#' && !$(this).is('.comment-reply-link, #cancel-comment-reply-link, .no-scroll'))
			   {
				   var container = $(this.hash);
				   
				   if(container.length)
				   {
					   var target = container.offset().top,
						   oldLocation=window.location.href.replace(window.location.hash, ''),
						   newLocation=this,
						   duration=800,
						   easing='easeOutQuint';
			
					   // make sure it's the same location      
					   if(oldLocation+newHash==newLocation)
					   {
					      // animate to target and set the hash to the window.location after the animation
					      $('html:not(:animated),body:not(:animated)').animate({ scrollTop: target }, duration, easing, function() {
					
					         // add new hash to the browser location
					         window.location.href=newLocation;
					      });
					
					      // cancel default click action
					      return false;
					   }
					}
				}
			});
		});
	};
})(jQuery);	


// -------------------------------------------------------------------------------------------
// Smooth scrooling when clicking on anchor links
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_hide_info_text = function(variables) 
	{
		return this.each(function()
		{
			var container 	= $(this),
				elements	= container.find('>*'),
				text		= container.find('.infotext'),
				close 		= $('.close_info_text', container);
				
				if(text.length) container.css("height","auto");
				
				close.click(function()
				{
					elements.animate({height:0, padding:0, opacity: 0},400, 'easeInBack');
					$.cookie(container.data('cookiename'), container.data('hash'), { expires: 365, path: '/' });
					return false;
				});
		
		});
	};
})(jQuery);	


// -------------------------------------------------------------------------------------------
// Ligthbox activation
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_activate_lightbox = function(variables) 
	{
		var defaults = 
		{
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"] , a[href*="screenr.com"]'
		};
		
		var options 	= $.extend(defaults, variables),
			win		    = $(window),
			ww			= parseInt(win.width(),10) * 0.8, 	//controls the default lightbox width: 80% of the window size
			wh 			= (ww/16)*9;						//controls the default lightbox height (16:9 ration for videos. images are resized by the lightbox anyway)
			
		
		return this.each(function()
		{
			var elements = $(options.autolinkElements, this).not('.noLightbox, .noLightbox a'),
				lastParent = "",
				counter = 0;
			
			elements.each(function()
			{
				var el = $(this),
					parentPost = el.parents('.post-entry:eq(0)'),
					group = 'auto_group';
				
				if(parentPost.get(0) != lastParent)
				{
					lastParent = parentPost.get(0);
					counter ++;
				}
					
				if((el.attr('rel') == undefined || el.attr('rel') == '') && !el.hasClass('noLightbox')) 
				{ 
					el.attr('rel','lightbox['+group+counter+']'); 
				}
			});
			
			if($.fn.prettyPhoto)
			elements.prettyPhoto({ social_tools:'',slideshow: 5000, deeplinking: false, overlay_gallery:false, default_width: ww, default_height: wh });							
		});
	};
})(jQuery);	




// -------------------------------------------------------------------------------------------
// Hover effect activation
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.avia_activate_hover_effect = function(variables) 
	{
		var defaults = 
		{
			autolinkElements: 'a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"], a.external-link, .avia_mega a, .dynamic_template_columns a'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{	
			$(options.autolinkElements, this).not(".noLightbox a").contents('img').each(function()
			{
				var img = $(this),
					a = img.parent(),
					preload = img.parents('.preloading'),
					$newclass = 'lightbox_video',
					applied= false;
					
				
				if(a.attr('href').match(/(jpg|gif|jpeg|png|tif)/)) 
				{ 
					$newclass = 'lightbox_image'; 
				}
				
				if(a.is('.external-link') || ! a.attr('href').match(/(jpg|gif|jpeg|png|\.tif|\.mov|\.swf|vimeo\.com|youtube\.com)/))
				{ 
					$newclass = 'external_image'; 
				}
				
				if(a.is('a'))
				{
					if(img.css('float') == 'left' || img.css('float') == 'right') {a.css({float:img.css('float')})}
					if(!a.css('position') || a.css('position') == 'static') { a.css({position:'relative', display:'inline-block'}); }
					if(img.is('.aligncenter')) a.css({display:'block'}); 
					if(img.is('.avia_mega img')) a.css({position:'relative', display:'inline-block'}); 
					if(img.css('left')) { a.css({left: img.css('left')}); img.css('left', 0); } 
				}
				
				var bg = $("<span class='image_overlay_effect'><span class='image_overlay_effect_inside'></span></span>").appendTo(a);
					bg.css({display:'block', zIndex:5, opacity:0});
				
				bg.hover(function()
				{	
					if(applied == false && img.css('opacity') > 0.5)
					{
						bg.addClass($newclass);
						applied = true;
					}	
					
					bg.stop().animate({opacity:0.6},400);
				},
				function()
				{
					bg.stop().animate({opacity:0},400);
				});
				
				
				
			});						
		});
	};
})(jQuery);














// -------------------------------------------------------------------------------------------
// content slider
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_sc_slider = function(variables, callback) 
	{
				
		return this.each(function()
		{
			var defaults = 
			{
				slidePadding: 40,
				appendControlls: {'h1':'pos_h1', 'h2':'pos_h2', 'h3':'pos_h3', 'h4':'pos_h4', 'h5':'pos_h5', 'h6':'pos_h6'},
				controllContainerClass: 'contentSlideControlls',
				transitionDuration: 800,								//how fast should images crossfade
				autorotation: true,										//autorotation true or false? (this setting gets overwritten by the class autoslide_true and autoslide_false if applied to the container. easier for shortcode management)
				autorotationInterval: 3000,								//interval between transition if autorotation is active ()also gets overwritten by autoslidedelay__(number)
				transitionEasing: 'easeOutQuint',
				slide: '.single_slide',
				group: false,
				arrowControll:false
			};
			
			var options = $.extend(defaults, variables);
			
			var container 	= $(this).css({overflow:'hidden'}),
				optionWrap 	= container.parent(':eq(0)'),
				slides 		= $(options.slide, container),
				isMobile 	= 'ontouchstart' in document.documentElement;
			
			if(!slides.length) { return false; }
			
			if(optionWrap.data('interval')){ options.autorotationInterval = optionWrap.data('interval') * 1000;}
			if(optionWrap.data('interval') === 0) options.autorotation = false;
				
			if(options.group)
			{
				var container_new = $('<div>').addClass(container.attr('class')).css({overflow:'hidden', width:'100%', position:'relative'}).insertAfter(container),
					start = 0,
					end  = slides.index(slides.filter('.last:eq(0)'));
					
				if(end === -1) end = slides.length;
					
				var columns = end + 1,
					elements = slides.length,
					subgroup = {}; 
				
				slides.appendTo(container_new);
				
				for (i = 0; i <= elements; i += columns)
				{
					
					subgroup = slides.slice(i, i + columns);
					if(subgroup.length)
					{
						subgroup.wrapAll('<div class="single_slide"></div>');
					}
				}
					
				slides.each(function()
				{
					var current = $(this);
					current.find('>*').wrapAll('<div class="'+current.attr('class')+'"></div>');
					current.find('>div:eq(0)').insertAfter(current);
				});
				
				//reset values
				slides.remove();
				container.remove();
				container = container_new;
				options.slide = '.single_slide';
				slides = $(options.slide, container);
			}

				
			var slideCount = slides.length,
				firstSlide = slides.filter(':eq(0)'),
				followslides = $(options.slide+':not(:first)', container),
				innerContainer = "",
				innerContainerWidth = (container.width() * slideCount) + (options.slidePadding * slideCount),
				i = 0,
				interval = "",
				controlls = $(),
				arrowControlls = $(),
				nextArrow,
				prevArrow;
			
			container.animating  = false;	
			container.methods = 
			{
				resize: function()
				{
					if(!innerContainer) return;
					
					innerContainerWidth = (container.width() * slideCount) + (options.slidePadding * slideCount);
					innerContainer.width(innerContainerWidth);
					slides.width(container.width());
					container.methods.change();
				},
				
				preload: function()
				{
					followslides.css({display:"none"});
										
					if(!slideCount)
					{
						container.methods.init();
					}
					else
					{
						container.aviaImagePreloader(container.methods.init);
					}
				},
				
				init: function()
				{
					if(slideCount > 1)
					{
						$(window).resize(container.methods.resize);
					
						//set container height to match the first slide
						container.height(firstSlide.height());
						
						//wrap additional container arround slides and align slides within that container
						slides.wrapAll('<div class="inner_slide_container" />').css({float:'left', 
																					 width:container.width(), 
																					 display:'block', 
																					 paddingRight:options.slidePadding
																					 });
																					 
						innerContainer = $('.inner_slide_container', container).width(innerContainerWidth);
						
						//attach controll elements
						container.methods.appenControlls();
						
						//start autoslide
						container.methods.autoRotation();
						
						//start autoslide
						container.methods.activate_touch_control();
					}
				},
				
				change: function()
				{
					container.animating = true;
					//move inner container
					var moveTo = ((-i * container.width()) - (i * options.slidePadding));
					innerContainer.stop().animate({left: moveTo}, options.transitionDuration, options.transitionEasing, function()
					{
						container.animating = false;
					});
					
					//change height of outer container
					var nextSlideHeight = slides.filter(':eq('+i+')').height();
					container.stop().animate({height: nextSlideHeight}, options.transitionDuration, options.transitionEasing);
					
					//change active state of controlls
					var controllLinks = $('a', controlls);
					controllLinks.removeClass('activeItem');
					controllLinks.filter(':eq('+i+')').addClass('activeItem');
				},
				
				activate_touch_control:function()
				{
					var slider = container;
					
					if(isMobile)
					{
						slider.touchPos = {};
						
						slider.bind('touchstart', function(event)
						{
							slider.touchPos.X = event.originalEvent.touches[0].clientX;
							slider.touchPos.Y = event.originalEvent.touches[0].clientY;

						});
						
						slider.bind('touchend', function(event)
						{
							slider.touchPos = {};
			                event.preventDefault();
						});
						
						slider.bind('touchmove', function(event)
						{
							if(!slider.touchPos.X) 
							{
								slider.touchPos.X = event.originalEvent.touches[0].clientX;
								slider.touchPos.Y = event.originalEvent.touches[0].clientY;
							}
							else
							{
								var differenceX = event.originalEvent.touches[0].clientX - slider.touchPos.X; 
								var differenceY = event.originalEvent.touches[0].clientY - slider.touchPos.Y; 
								
								//check if user is scrolling the window or moving the slider
								if(Math.abs(differenceX) > Math.abs(differenceY)) 
								{
									event.preventDefault();
									
									if(!slider.animating)
									{	
										if(slider.touchPos != event.originalEvent.touches[0].clientX)
										{
											if(Math.abs(differenceX) > 50)
											{
												i = differenceX > 0 ? i - 1 : i + 1;
												
												if(i+1 > slideCount) { i = 0; } else
												if(i < 0) {i = slideCount-1; }
												
												clearInterval(interval);
												container.methods.change();
												slider.touchPos = {};
												return false;
						                	}
						                }
						
					                }
				                }
			                }
		            	});
					}
					
				},
				
				setSlideNumber: function(event)
				{
					var stop = false;
					
					if(event)
					{ 
						clearInterval(interval);
						
						if(event.data.show == 'next') i++;
						if(event.data.show == 'prev') i--;
						if(typeof(event.data.show) == 'number') 
						{
							//check if next slide is the same as current slide
							if(i != event.data.show) 
							{
								i = event.data.show;
							}
							else
							{
								stop = true;
							}
						}
					}
					else
					{
						i++;
					}
					
					if(i+1 > slideCount) { i = 0; } else
					if(i < 0) {i = slideCount-1; }
					
					if(!stop) // prevents transition if the next slide and the current slide are the same
					{
					    container.methods.change();
					}

					
					
					return false;
				},
				
				appenControlls: function()
				{
					//if controlls should be added by javascript and we got more than 1 slide 
					if(options.appendControlls && slideCount > 1)
					{	
						//check where to position the controll element, depending on the first element within the slide
						var positioningClass = '';
						
						for (var key in options.appendControlls)
						{
							if(!positioningClass)
							{
								if($(':first', firstSlide).is(key))
								{
									positioningClass = options.appendControlls[key];
								}
								
							}
						}
						
						
						//append the controlls
						var firstClass = 'class="activeItem"';
						
						controlls = $('<div></div>').addClass(options.controllContainerClass)
													.addClass(positioningClass)
													.css({visibility:'hidden', opacity:0});
														
							if(positioningClass)
							{
								controlls.appendTo(container);
							}							
							else
							{
								controlls.insertAfter(container);
							}
														
						slides.each(function(i)
						{ 
							var link = $('<a '+firstClass+' href="#">'+(i+1)+'</a>').appendTo(controlls); firstClass = ""; 
								link.bind('click', {show: i}, container.methods.setSlideNumber);
						});
						
						controlls.css({visibility:'visible', opacity:0}).animate({opacity:0.7},400);
					}
					
					//add arrow Controlls
					if(options.arrowControll && slideCount > 1)
					{
						arrowControlls = $('<div class="arrow_container"></div>');
						nextArrow = $('<a class="arrow_controll arrow_controll_next" href="#next">+</a>').appendTo(arrowControlls).bind('click', {show: 'next'}, container.methods.setSlideNumber).css({visibility:'visible', opacity:0});
						prevArrow = $('<a class="arrow_controll arrow_controll_prev" href="#prev">-</a>').appendTo(arrowControlls).bind('click', {show: 'prev'}, container.methods.setSlideNumber).css({visibility:'visible', opacity:0});
					}
					
					if(positioningClass)
					{
						arrowControlls.appendTo(container);
					}							
					else
					{
						arrowControlls.insertAfter(container);
					}
					
					if(!isMobile)
					{
						arrowControlls.parent().hover(function()
						{
							prevArrow.stop().animate({opacity:0.7},400);
							nextArrow.stop().animate({opacity:0.7},400);
						},
						function()
						{
							prevArrow.stop().animate({opacity:0},400)
							nextArrow.stop().animate({opacity:0},400)
						});
					}
					
					
				},
				
				autoRotation: function()
				{
					
					if(container.is('.autoslide_true'))
					{
						options.autorotation = true;
						
					var myRegexp = /autoslidedelay__(\d+)/g;
					var match = myRegexp.exec(container[0].className);
					
					if(parseInt(match[1]) > 0)
					{
						options.autorotationInterval = parseInt(match[1]) * 1000;
					}
					

						
					}
					else if(container.is('.autoslide_false'))
					{
						options.autorotation = false;
					}
				
				
					if(options.autorotation)
					{
						interval = setInterval(function()
						{ 	
							container.methods.setSlideNumber();
						},
						options.autorotationInterval);
					}
				}
			};
			
			
			container.methods.preload();
			
		});
	};
})(jQuery);

	






// -------------------------------------------------------------------------------------------
// contact form ajax improvements
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.kriesi_ajax_form = function(variables) 
	{
		var defaults = 
		{
			sendPath: 'send.php',
			responseContainer: '#ajaxresponse'
		};
		
		var options = $.extend(defaults, variables);
		
		return this.each(function()
		{
			var form = $(this),
				form_sent = false,
				send = 
				{
					formElements: form.find('textarea, select, input[type=text], input[type=checkbox], input[type=hidden]'),
					validationError:false,
					button : form.find('input:submit'),
					dataObj : {}
				};
			
			responseContainer = $(options.responseContainer+":eq(0)");
			
			send.button.bind('click', checkElements);
			
			function send_ajax_form()
			{
				if(form_sent){ return false; }
				
				form_sent = true;
				send.button.fadeOut(300);	
				
				responseContainer.load(form.attr('action')+' '+options.responseContainer, send.dataObj, function()
				{
					responseContainer.find('.hidden').css({display:"block"});
					form.slideUp(400, function(){responseContainer.slideDown(400); send.formElements.val('');});
				});
									
				
			}
			
			function checkElements()
			{	
				// reset validation var and send data
				send.validationError = false;
				send.datastring = 'ajax=true';
				
				send.formElements.each(function(i)
				{
					var currentElement = $(this),
						surroundingElement = currentElement.parent(),
						value = currentElement.val(),
						name = currentElement.attr('name'),
					 	classes = currentElement.attr('class'),
					 	nomatch = true;
					 	
					 	if(currentElement.is(':checkbox'))
					 	{
					 		if(currentElement.is(':checked')) { value = true} else {value = ''}
					 	}
					 	
					 	send.dataObj[name] = encodeURIComponent(value);
					 	
					 	if(classes && classes.match(/is_empty/))
						{
							if(value == '')
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}
							nomatch = false;
						}
						
						if(classes && classes.match(/is_email/))
						{
							if(!value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/))
							{
								surroundingElement.attr("class","").addClass("error");
								send.validationError = true;
							}
							else
							{
								surroundingElement.attr("class","").addClass("valid");
							}	
							nomatch = false;
						}
						
						if(nomatch && value != '')
						{
							surroundingElement.attr("class","").addClass("valid");
						}
				});
				
				if(send.validationError == false)
				{
					send_ajax_form();
				}
				return false;
			}
		});
	};
})(jQuery);






jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});


function avia_log(text) 
{    
		var logfield = jQuery('.avia_logfield');
		if(!logfield.length) logfield = jQuery('<pre class="avia_logfield"></pre>').appendTo('body').css({	zIndex:100000, 
																											padding:"20px", 
																											backgroundColor:"#ffffff", 
																											position:"fixed", 
																											top:0, right:0, 
																											width:"300px",
																											borderColor:"#cccccc",
																											borderWidth:"1px",
																											borderStyle:'solid',
																											height:"600px",
																											overflow:'scroll',
																											display:'block',
																											zoom:1
																											});
		var val = logfield.html();
		var text = avia_get_object(text);
		logfield.html(val + "\n<br/>" + text);
	
	
	function avia_get_object(obj)
	{
		var sendreturn = obj;
		
		if(typeof obj == 'object' || typeof obj == 'array')
		{
			for (i in obj)
			{
				sendreturn += "'"+i+"': "+obj[i] + "<br/>";
			}
		}
		
		return sendreturn;
	}
}

// -------------------------------------------------------------------------------------------
// image preloader
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.aviaImagePreloader = function(variables, callback) 
	{
		var defaults = 
		{
			fadeInSpeed: 800,
			delay:0,
			maxLoops: 10,
			thisData: {},
			data: ''
		};
		
		var options = $.extend(defaults, variables);
			
		return this.each(function()
		{
			var container 	= $(this),
				images		= $('img', this).css({opacity:0, visibility:'visible', display:'block'}),
				parent = images.parent().addClass('preloading'),
				imageCount = images.length,
				interval = '',
				allImages = images ;
							
			
			var methods = 
			{
				checkImage: function()
				{
					images.each(function(i)
					{
						if(this.complete == true) images = images.not(this);
					});
					
					if(images.length && options.maxLoops >= 0)
					{
						options.maxLoops--;
						setTimeout(methods.checkImage, 500);
					}
					else
					{
						methods.showImages();
					}
				},
				
				showImages: function()
				{
					allImages.each(function(i)
					{
						var currentImage = $(this);
						setTimeout(function()
						{
							methods.showSingleImage(currentImage, i);
						},options.delay * i);
						
						
					});
				},
				
				showSingleImage: function(currentImage, i)
				{
					currentImage.animate({opacity:1}, options.fadeInSpeed, function()
					{
						currentImage.parents().removeClass('preloading');
						if(allImages.length == i+1) 
						{
							methods.callback(i);
						}
					});
				},
				
				callback: function()
				{		
					if (variables instanceof Function) { callback = variables; }
					if (callback  instanceof Function) { callback.call(options.thisData, options.data);  }
				}
			};
			
			if(!images.length) { methods.callback(); return }
			methods.checkImage();

		});
	};
})(jQuery);







function avia_iframe_fix()
{
	var iframe 	= jQuery('.slideshow iframe'),
		youtubeEmbed = jQuery('.slideshow object, .slideshow embed').attr('wmode','opaque');
		
		iframe.each(function()
		{
			var current = jQuery(this),
				src 	= current.attr('src');
			
			if(src)
			{
				if(src.indexOf('?') !== -1)
				{
					src += "&wmode=opaque";
				}
				else
				{
					src += "?wmode=opaque";
				}
				
				current.attr('src', src);
			}
		});
}



/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : cookie_encode(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

function cookie_encode(string){
	//full uri decode not only to encode ",; =" but to save uicode charaters
	var decoded = encodeURIComponent(string);
	//encod back common and allowed charaters {}:"#[] to save space and make the cookies more human readable
	var ns = decoded.replace(/(%7B|%7D|%3A|%22|%23|%5B|%5D)/g,function(charater){return decodeURIComponent(charater);});
	return ns;
}




/**
 * Isotope v1.5.03
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2011 David DeSandro / Metafizzy
 */
/*jshint curly: true, eqeqeq: true, forin: false, immed: false, newcap: true, noempty: true, undef: true */
/*global Modernizr: true, jQuery: true */
(function(a,b,c){"use strict";var d=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},e="Moz Webkit Khtml O Ms".split(" "),f=function(a){var b=document.documentElement.style,c;if(typeof b[a]=="string")return a;a=d(a);for(var f=0,g=e.length;f<g;f++){c=e[f]+a;if(typeof b[c]=="string")return c}},g=f("transform"),h=f("transitionProperty"),i={csstransforms:function(){return!!g},csstransforms3d:function(){var a=!!f("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),g=b('<div id="modernizr" />').appendTo("html");a=g.height()===3,g.remove(),e.remove()}return a},csstransitions:function(){return!!h}};if(a.Modernizr)for(var j in i)Modernizr.hasOwnProperty(j)||Modernizr.addTest(j,i[j]);else a.Modernizr=function(){var a={_version:"1.6ish: miniModernizr for Isotope"},c=" ",d,e;for(e in i)d=i[e](),a[e]=d,c+=" "+(d?"":"no-")+e;b("html").addClass(c);return a}();if(Modernizr.csstransforms){var k=Modernizr.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},l=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},h,i={},j;f[c]=d,b.extend(e,f);for(h in e)j=e[h],i[h]=k[h](j);var l=i.translate||"",m=i.scale||"",n=l+m;b.data(a,"isoTransform",e),a.style[g]=n};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){l(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){l(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var m,n;Modernizr.csstransitions&&(m={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd",transitionProperty:"transitionEnd"}[h],n=f("transitionDuration"));var o=b.event,p;o.special.smartresize={setup:function(){b(this).bind("resize",o.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",o.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",p&&clearTimeout(p),p=setTimeout(function(){jQuery.event.handle.apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var q=["overflow","position","width","height"];b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:Modernizr.csstransforms&&!b.browser.opera?{opacity:0,scale:.001}:{opacity:0},visibleStyle:Modernizr.csstransforms&&!b.browser.opera?{opacity:1,scale:1}:{opacity:1},animationEngine:b.browser.opera?"jquery":"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!0,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(c){this.options=b.extend({},b.Isotope.settings,c),this.styleQueue=[],this.elemCount=0;var d=this.element[0].style;this.originalStyle={};for(var e=0,f=q.length;e<f;e++){var g=q[e];this.originalStyle[g]=d[g]||""}this.element.css({overflow:"hidden",position:"relative"}),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){b.elemCount++;return b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems();var i=b(document.createElement("div")).prependTo(this.element);this.offset=i.position(),i.remove();var j=this;setTimeout(function(){j.element.addClass(j.options.containerClass)},0),this.options.resizable&&b(a).bind("smartresize.isotope",function(){j.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0);return c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var e in a)c="_update"+d(e),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,"");switch(a){case"css":case"none":this.isUsingJQueryAnimation=!1;break;case"jquery":this.isUsingJQueryAnimation=!0;break;default:this.isUsingJQueryAnimation=!Modernizr.csstransitions}this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){this.usingTransforms=this.options.transformsEnabled&&Modernizr.csstransforms&&Modernizr.csstransitions&&!this.isUsingJQueryAnimation,this.getPositionStyles=this.usingTransforms?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c);return a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order"));return(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b+=this.offset.left,c+=this.offset.top;var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",e=this.options.animationOptions,f,g,h,i;g=function(a,b){b.$el[d](b.style,e)};if(this._isInserting&&this.isUsingJQueryAnimation)g=function(a,b){f=b.$el.hasClass("no-transition")?"css":d,b.$el[f](b.style,e)};else if(c){var j=!1,k=this;h=!0,i=function(){j||(c.call(k.element,a),j=!0)};if(this.isUsingJQueryAnimation&&d==="animate")e.complete=i,h=!1;else if(Modernizr.csstransitions){var l=0,o=this.styleQueue[0].$el,p;while(!o.length){p=this.styleQueue[l++];if(!p)return;o=p.$el}var q=parseFloat(getComputedStyle(o[0])[n]);q>0&&(g=function(a,b){b.$el[d](b.style,e).one(m,i)},h=!1)}}b.each(this.styleQueue,g),h&&i(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a,!0);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a){this.$allAtoms=this.$allAtoms.not(a),this.$filteredAtoms=this.$filteredAtoms.not(a),a.remove()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var c=this.usingTransforms;this.$allAtoms.removeClass(this.options.hiddenClass+" "+this.options.itemClass).each(function(){this.style.position="",this.style.top="",this.style.left="",this.style.opacity="",c&&(this.style[g]="")});var d=this.element[0].style;for(var e=0,f=q.length;e<f;e++){var h=q[e];d[h]=this.originalStyle[h]}this.element.unbind(".isotope").undelegate("."+this.options.hiddenClass,"click").removeClass(this.options.containerClass).removeData("isotope"),b(a).unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",e=a?"height":"width",f=a?"rows":"cols",g=this.element[e](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+d(e)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][f]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];this._getSegments(a);return this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=Math.round((e+.5)*d.columnWidth-a.outerWidth(!0)/2),h=Math.round((f+.5)*d.rowHeight-a.outerHeight(!0)/2);c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=Math.round((e+.5)*d.columnWidth-a.outerWidth(!0)/2),h=Math.round((f+.5)*d.rowHeight-a.outerHeight(!0)/2);c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(a){--e<=0&&a.target.src!==f&&(setTimeout(g),d.unbind("load error",h))}function g(){a.call(b,d)}var b=this,d=b.find("img").add(b.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";e||g(),d.bind("load error",h).each(function(){if(this.complete||this.complete===c){var a=this.src;this.src=f,this.src=a}});return b};var r=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c)r("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");else{if(!b.isFunction(c[a])||a.charAt(0)==="_"){r("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)}})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);





(function($){

  //variable for storing the menu count when no ID is present
  var menuCount = 0;
  
  //plugin code
  $.fn.mobileMenu = function(options){
    
    //plugin's default options
    var settings = {
      switchWidth: 768,
      topOptionText: 'Select a page',
      indentString: '&nbsp;&nbsp;&nbsp;'
    };
    
    
    //function to check if selector matches a list
    function isList($this){
      return $this.is('ul, ol');
    }
  
  
    //function to decide if mobile or not
    function isMobile(){
      return ($(window).width() < settings.switchWidth);
    }
    
    
    //check if dropdown exists for the current element
    function menuExists($this){
      
      //if the list has an ID, use it to give the menu an ID
      if($this.attr('id')){
        return ($('#mobileMenu_'+$this.attr('id')).length > 0);
      } 
      
      //otherwise, give the list and select elements a generated ID
      else {
        menuCount++;
        $this.attr('id', 'mm'+menuCount);
        return ($('#mobileMenu_mm'+menuCount).length > 0);
      }
    }
    
    
    //change page on mobile menu selection
    function goToPage($this){
      if($this.val() !== null){document.location.href = $this.val()}
    }
    
    
    //show the mobile menu
    function showMenu($this){
      $this.css('display', 'none');
      $('#mobileMenu_'+$this.attr('id')).show();
    }
    
    
    //hide the mobile menu
    function hideMenu($this){
      $this.css('display', '');
      $('#mobileMenu_'+$this.attr('id')).hide();
    }
    
    
    //create the mobile menu
    function createMenu($this){
      if(isList($this)){
                
        //generate select element as a string to append via jQuery
        var selectString = '<select id="mobileMenu_'+$this.attr('id')+'" class="mobileMenu">';
        
        //create first option (no value)
        selectString += '<option value="">'+settings.topOptionText+'</option>';
        
        //loop through list items
        $this.find('li').each(function(){
          
          //when sub-item, indent
          var levelStr = '';
          var len = $(this).parents('ul, ol').length;
          for(i=1;i<len;i++){levelStr += settings.indentString;}
          
          //get url and text for option
          var link = $(this).find('a:first-child').attr('href');
          var text = levelStr + $(this).clone().children('ul, ol').remove().end().text();
          
          //add option
          selectString += '<option value="'+link+'">'+text+'</option>';
        });
        
        selectString += '</select>';
        
        //append select element to ul/ol's container
        $this.parent().append(selectString);
        
        //add change event handler for mobile menu
        $('#mobileMenu_'+$this.attr('id')).change(function(){
          goToPage($(this));
        });
        
        //hide current menu, show mobile menu
        showMenu($this);
      } else {
        alert('mobileMenu will only work with UL or OL elements!');
      }
    }
    
    
    //plugin functionality
    function run($this){
      
      //menu doesn't exist
      if(isMobile() && !menuExists($this)){
        createMenu($this);
      }
      
      //menu already exists
      else if(isMobile() && menuExists($this)){
        showMenu($this);
      }
      
      //not mobile browser
      else if(!isMobile() && menuExists($this)){
        hideMenu($this);
      }

    }
    
    //run plugin on each matched ul/ol
    //maintain chainability by returning "this"
    return this.each(function() {
      
      //override the default settings if user provides some
      if(options){$.extend(settings, options);}
      
      //cache "this"
      var $this = $(this);
    
      //bind event to browser resize
      $(window).resize(function(){run($this);});

      //run plugin
      run($this);

    });
    
  };
  
})(jQuery);