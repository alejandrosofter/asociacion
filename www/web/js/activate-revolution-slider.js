//###########################			
/*ACTIVATE REVOLUTION SLIDER */	
//###########################
								
	var tpj=jQuery;
	tpj.noConflict();
	
	tpj(document).ready(function() {
	
	if (tpj.fn.cssOriginal!=undefined)
		tpj.fn.css = tpj.fn.cssOriginal;

		tpj('.fullwidthbanner').revolution(
			{	
				delay:9000,												
				startwidth:890,
				startheight:540,
				
				onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off
				
				thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
				thumbHeight:50,
				thumbAmount:4,
				
				hideThumbs:200,
				navigationType:"both",					//bullet, thumb, none, both	 (No Shadow in Fullwidth Version !)
				navigationArrows:"verticalcentered",		//nexttobullets, verticalcentered, none
				navigationStyle:"round",				//round,square,navbar
				
				touchenabled:"on",						// Enable Swipe Function : on/off
				
				navOffsetHorizontal:395,
				navOffsetVertical:20,
				
				fullWidth:"on",

				shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
											
			});	
		
			
});