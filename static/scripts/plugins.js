// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
jQuery.fn.extend({
    hoversiblings: function () {
	this.each( function(){
		$(this).hover(
			function (){
				$(this).siblings().stop().fadeTo(300, 0.7);
						},
			function (){
				$(this).siblings().stop().fadeTo(300, 1);
					   });
		});
		return this;
    }		
});
//
// @plugin with options
jQuery.fn.extend({
    hoversiblings2: function (options) {
		var defaults = {  
				timeEfect: 300,
				opacity: 0.9  			
			};  
	var options = $.extend(defaults, options); 			
	this.each( function(){
		$(this).hover(
			function (){
				$(this).siblings().stop().fadeTo(options.timeEfect, options.opacity);
						},
			function (){
				$(this).siblings().stop().fadeTo(options.timeEfect, 1);
					   });
		});
		return this;
    }		
});

  // PLUGIN DE MUESTRA DE CONTENIDO QUE USA JQUERY UI EFFECTS
 jQuery.fn.extend({
        showcontent: function () {
            this.each(function () {
				var effect = "clip";             
                var options = {
                    direction: 'vertical'
                };
               $(':animated', $(this).parent()).stop(true, true);			   
                if ($(this).is(':visible')) {
                    $(this).siblings('li').hide();
                } else {
                    $(this).siblings('li').hide();
                    if (!$(this).is(":animated")) {
                        $(this).toggle(effect, options, 1000);
                    }
                }
            });
            return this;
        }
    });
/**/

