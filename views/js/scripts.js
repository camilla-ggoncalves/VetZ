$(window).on('load', function(){

	"use strict";

	var footer_year = document.getElementById("footer-year");
	if (footer_year) {
		footer_year.innerHTML = new Date().getFullYear();
	}
	
	/* ========================================================== */
	/*   Navigation Background Color                              */
	/* ========================================================== */
	
	$(window).on('scroll', function() {
		if($(this).scrollTop() > 450) {
			$('.navbar-fixed-top').addClass('opaque');
		} else {
			$('.navbar-fixed-top').removeClass('opaque');
		}
	});
 
	
	/* ========================================================== */
	/*   Hide Responsive Navigation On-Click                      */
	/* ========================================================== */
	
	  $(".navbar-nav li a").on('click', function(event) {
	    $(".navbar-collapse").collapse('hide');
	  });

	
	/* ========================================================== */
	/*   Navigation Color                                         */
	/* ========================================================== */
	
	var navbarCollapse = $('#navbarCollapse');

	if (navbarCollapse.length) {
		navbarCollapse.onePageNav({ /* Para API - Camilla */
			filter: function() {
				var href = $(this).attr('href');
				return href && href !== '#' && href.charAt(0) === '#';
			}
		}); 		
	}


	/* ========================================================== */
	/*   SmoothScroll                                             */
	/* ========================================================== */
	
	$(".navbar-nav li a, a.scrool").on('click', function(e) {
		
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		
		$('html,body').animate({scrollTop:target_top -70}, 1000);
			return false;
		
	});	

});

		/* ========================================================== */
	/*   API Youtube - Vídeos Atuais e Antigos - ChatGPT          */
	/* ========================================================== */

// Defina sua chave de API do YouTube aqui
const apiKey = 'AIzaSyCK_SS_gw9xG9m5xAo3aO6dZ-6sWqWaK0w';

// Função para carregar a API do YouTube
function loadYouTubeAPI() {
	gapi.client.init({
		'apiKey': apiKey,
	}).then(() => {
		getVideosByKeyword('animais, veterinaria, cuidado animal'); //buscar vídeos por palavras-chave
	});
}

// Função para buscar vídeos com base em palavras-chave - Isso é a DECLARAÇÃO da função (define o que ela faz)
function getVideosByKeyword(query) {
    gapi.client.request({
        'path': '/youtube/v3/search', //API
        'params': {
            'part': 'snippet',
            'q': query,  // Palavra-chave para busca
            'maxResults': 10,
            'order': 'date',  // Ordenar por data (mais recente)
            'type': 'video',  // Filtrar apenas vídeos
        }
    }).then(response => {
        console.log(response);  // Verifique o que está sendo retornado pela API
        // Exibir vídeos na página
        displayVideos(response.result.items);
    });
}


// Função para exibir vídeos no HTML
function displayVideos(videos) {
	const videoList = document.getElementById('video-list');
	videoList.innerHTML = '';  // Limpar a lista antes de adicionar os novos vídeos
	
	videos.forEach(video => {
		const title = video.snippet.title;
		const videoUrl = `https://www.youtube.com/watch?v=${video.id.videoId}`; //cada vídeo tem seu próprio ID

		// Criando um item de lista para o vídeo
		const listItem = document.createElement('li');
		listItem.innerHTML = `
			<a href="${videoUrl}" target="_blank"> 
				<img src="${video.snippet.thumbnails.default.url}" alt="${title}"> 
				<p>${title}</p>
			</a>
		`; //miniatura (imagem) do vídeo; o default é o tamanho menor; o vídeo abre em nova aba; aparece a thumbnail; aparece título

		videoList.appendChild(listItem);
	});
}

// Função chamada quando a API é carregada
function start() {
	gapi.load('client', loadYouTubeAPI);
}

// Iniciar a API quando a página carregar
window.onload = start;