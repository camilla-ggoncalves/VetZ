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
		navbarCollapse.onePageNav({
			filter: ':not(.external)'
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
const apiKey = 'AIzaSyCkzEH7VDksYPONQC3CoKqhNih4JK7fhh4';

// Função para carregar a API do YouTube
function loadYouTubeAPI() {
    gapi.client.init({
        'apiKey': apiKey,
    }).then(() => {
        getVideosByKeyword('animais veterinária cuidados com o pet zootecnia domésticos silvestres selvagens'); //buscar vídeos por palavras-chave
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
        listItem.innerHTML = `<a href="${videoUrl}" target="_blank">${title}</a>`;
        videoList.appendChild(listItem);
    });
}

// Função chamada quando a API é carregada
function start() {
    gapi.load('client', loadYouTubeAPI);
}

// Iniciar a API quando a página carregar
window.onload = start;
