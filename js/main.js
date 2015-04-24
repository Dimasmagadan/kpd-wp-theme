(function( $ ) {
	"use strict";
 
		$(document).ready(function(){

			// quick fix - if no featured images used
			// if($('.archive').length){
			// 	$.each( $('article a img'), function( i, e ) {
			// 		$(e).parent().attr({
			// 			'href': $(e).parents('article').find('h3 a').attr('href'),
			// 			'rel': 'bookmark'
			// 		});
			// 	});
			// }

			//$('a[rel="lightbox"]').magnificPopup({
			//	gallery: {
			//		enabled: true
			//	},
			//	type: 'image'
			//});

			$('a[rel="lightbox"]').magnificPopup({
				tClose: os.tClose,
				tLoading: os.tLoading,
				image: {
					tError: os.tError
				},
				ajax: {
					tError: os.tError
				},
				gallery: {
					tPrev: os.tPrev,
					tNext: os.tNext,
					tCounter: os.tCounter,
					enabled: true
				},
				zoom: {
					enabled: true,
					duration: 300
				},
				type: 'image',
				callbacks: {
					buildControls: function() {
						this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
					}
				}
			});

		});
 
}(jQuery));
