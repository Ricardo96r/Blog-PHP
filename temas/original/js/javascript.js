$(document).ready(function() {
	
	/*
		Tooltip
	*/
    $('.time').tooltip();
	$('.responder-comentario').tooltip();
	
	/*
		Affix
	*/
  $('.affix-comentarios').affix({
    offset: {
	 top: function () {
        return ((this.bottom = $('.height-pb').outerHeight(true)) + (this.bottom = $('.height-nav').outerHeight(true)))
      }
    , bottom: function () {
        return (this.bottom = $('.footer').outerHeight(true))
      }
    }
  })
  
  /*
  Cierre de ready document
  */
});


/*
	Datos de SPIN.JS
*/
var opts = {
  lines: 13, // The number of lines to draw
  length: 6, // The length of each line
  width: 2, // The line thickness
  radius: 6, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#FF8E00', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '50%', // Top position relative to parent
  left: '50%' // Left position relative to parent
};