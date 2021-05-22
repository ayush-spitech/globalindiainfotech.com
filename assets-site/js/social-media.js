WebFontConfig = {
  google: { families: [ 'Lato:400,700,300:latin' ] }
};
(function() {
  var wf = document.createElement('script');
  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

// Initialize Share-Buttons
$.contactButtons({
  effect  : 'slide-on-scroll',
  buttons : {
    'facebook':   { class: 'facebook', use: true, link: 'https://www.facebook.com/cpwsbilaspur', extras: 'target="_blank"' },
	'twitter':   { class: 'twitter', use: true, link: 'https://twitter.com/cpwsbilaspur', extras: 'target="_blank"'  },
   
    'google':     { class: 'gplus',    use: true, link: 'https://plus.google.com/+Cpwsbilaspur', extras: 'target="_blank"'   },
	 'youtube':   { class: 'youtube', use: true, link: 'https://www.youtube.com/channel/UCAqjGmNhH0bSve7eiHh1KsA', extras: 'target="_blank"'   },
    
    
  }
});