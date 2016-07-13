(function(window, $){
	'use strict';

	var Home = {
		setup: function()
		{
			var xhr;
			var hash = window.location.hash.substr(1);
			var time = '';
			if(!hash){
				Home.ClickLink.setup();
				Home.ClickLink.refresh(time);
			} else {
				Home.ClickLink.setup(jQuery('.'+hash));
				if(hash == 'home'){
					Home.ClickLink.refresh(time);
				} else {
					if(time){
						clearInteval(time);
					}
				}
			}

			var width = $(window).width();
			console.log(width);

			// jQuery(".tabela-times-time-link").attr('href', 'javascript:;')
			// jQuery(".placar-jogo-complemento").remove();
			// jQuery('.placar-jogo-link').attr('href', 'javascript:;');

			jQuery('ul.nav.nav-tabs.nav-justified li a').off('click');
			jQuery('ul.nav.nav-tabs.nav-justified li a').on('click', function(e)
				{
					jQuery('ul.nav.nav-tabs.nav-justified li').removeClass('active');
					Home.ClickLink.setup(jQuery(this));
				}
			);

			jQuery('.tabela-navegacao-setas-ativa').off('click');
			jQuery('.tabela-navegacao-setas-ativa').on('click', function(e)
				{
					// alert('asd');
					// var round = jQuery(this).data('rodada'),
					// 	direction = right;
					// console.log(round);
					// if(jQuery(this).hasClass('gui-icon-arrow-left-highlight')){
					// 	direction = 'left';
					// }
					// Home.NavRound.setup(round, direction);
				}
			);
		},
		ClickLink: {
			setup: function(element, complement)
			{
				if(element == undefined){
					element = jQuery('.home');
				}
				jQuery('ul.nav.nav-tabs.nav-justified li').removeClass('active');
				element.parent().addClass('active');
				var link = element.data('link');
				jQuery("#content").html('<img src="images/hourglass.gif" class="loadingContent" />');
				if (typeof this.xhr !== 'undefined'){
                    this.xhr.abort();
				}
				if(complement == undefined){
					complement = '';
				}
				this.xhr = jQuery.ajax({ url: link+'.php' + complement, dataType: 'html',
					success: function(response) {
						if(link == 'index'){
							jQuery('#content').html(jQuery(response).find('div'[0]).html());								console.log(response);
						} else {
							jQuery('#content').html(response);
						}
					}
				});
			},
			refresh: function(time)
			{
				time = setInterval(Home.ClickLink.setup, 120000);
			}
		},
		NavRound: {
			setup: function(round, direction)
			{
				if(round > 0 && round < 39){
					if(direction == 'left'){
						round++;
					} else {
						round--;
					}
					Home.ClickLink.setup(jQuery(this), '?round='+round);
				}
			}
		}
	}

	Home.setup();

})(window, jQuery);