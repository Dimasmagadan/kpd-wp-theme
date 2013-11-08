jQuery(document).ready(function($){

	// $('a[rel="lightbox"]').magnificPopup({
	// 	gallery: {
	// 		enabled: true
	// 	},
	// 	type: 'image'
	// });

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
