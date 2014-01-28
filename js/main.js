(function( $ ) {
	"use strict";
 
	$(function() {
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
				tClose: 'Закрыть (Esc)',
				tLoading: 'Загрузка...',
				image: {
					tError: '<a href="%url%">ссылку</a> загрузить не вышло.'
				},
				ajax: {
					tError: '<a href="%url%">ссылку</a> загрузить не вышло.'
				},
				gallery: {
					tPrev: 'Туда (влево)',
					tNext: 'Сюда (вправо)',
					tCounter: '%curr% из %total%',
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
	});
 
}(jQuery));
