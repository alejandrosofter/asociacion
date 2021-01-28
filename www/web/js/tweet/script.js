$(document).ready(function(){
	
	// Using our tweetAction plugin. For a complete list with supported
	// parameters, refer to http://dev.twitter.com/pages/intents#tweet-intent
	
	$('#tweetLink').tweetAction({
		text:		'Get this awesome "Product Name" for free',
		url:		'http://yourwebsite.com',
		via:		'yourwebsite',
		related:	'yourwebsite'
	},function(){
		
		// When the user closes the pop-up window:
		
		$('a.downloadButton')
				.addClass('active')
				.attr('href','http://demo.tutorialzine.com/2011/05/tweet-to-download-jquery/tweet_to_download.zip');

	});
	
});