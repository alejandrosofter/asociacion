var testData = {};
	

// The object that the JSON string should represent, can use this as it is if you want.
testData.webSites = [
	{
		id: 1,
		text: 'Dribbble',
		image: 'js/searchData/icons/dribbble.png',
		extra: '@dajy, @titanicthemes',
		url:'http://dribbble.com/dajy'
	},
	{
		id: 2,
		text: 'Digg',
		image: 'js/searchData/icons/Digg.png',
		extra: 'user',
		url:'#'	
	},
	{
		id: 3,
		text: 'Flickr',
		image: 'js/searchData/icons/Flickr.png',
		extra: '/Your user',
		url:'#'				
	},
	{
		id: 4,
		text: 'Titanic Themes',
		image: 'js/searchData/icons/titanicthemes.png',
		extra: 'Website Developer',
		url:'http://www.titanicthemes.com'		
	},
	{
		id: 5,
		text: 'Youtube',
		image: 'js/searchData/icons/Youtube.png',
		extra: 'TitanicThemes',
		url:'http://www.youtube.com/user/TitanicThemes'		
	},
	{
		id: 6,
		text: 'Github',
		image: 'js/searchData/icons/github.png',
		extra: '/your user',
		url:'#'				
	},
	{
		id: 7,
		text: 'Support',
		image: 'js/searchData/icons/support.png',
		extra: '/contact.html',
	    url:'contact.html'		
	},
	{
		id: 8,
		text: 'Frequently Questions',
		image: 'js/searchData/icons/faq.png',
		extra: '/faq.html',
	    url:'contact.html'		
	},
	{
		id: 9,
		text: 'Twitter',
		image: 'js/searchData/icons/Twitter.png',
		extra: '@titanicthemes',
		url:'https://twitter.com/titanicthemes'		
	},
	{
		id: 10,
		text: 'Facebook',
		image: 'js/searchData/icons/facebook.png',
		extra: '@titanicthemes',
		url:'http://www.facebook.com/titanicthemes'		
	},
	{
		id: 11,
		text: 'Email us',
		image: 'js/searchData/icons/email.png',
		extra: 'Use our contact form',
		url:'contact.html'		
	}
	];
	
// JSON string of the above object, just as an example
testData.webSitesJSON = JSON.stringify(testData.webSites);