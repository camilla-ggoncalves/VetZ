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

// Lista dos canais confiáveis (IDs dos canais no YouTube)
const canaisVeterinarios = [
    'UCsKneoQQHq93LsJpfspj_6A',  // Tudo sobre Cachorros
    'UCTU-01IN0p5JXB7VxEzDdJg',   // Perito Animal
	'UCpfYQpjkTmxMPN1vUoTaAMw' // Dica do Veterinário
];

// Função para carregar a API do YouTube
function loadYouTubeAPI() {
    gapi.client.init({
        'apiKey': apiKey,
    }).then(() => {
        getVideosDeCanaisVeterinarios();  // Busca vídeos dos canais confiáveis
    });
}

// retorna uma Promise com os vídeos (promise = promete que após carregado terá um resultado que funcionou ou não funcionou)
function buscarVideosDoCanal(channelId) {
    return gapi.client.request({
        'path': '/youtube/v3/search', //API
        'params': {
            'part': 'snippet',
            'channelId': channelId,
            'maxResults': 5, //5 vídeos de cada canal
            'order': 'date',  // Ordenar por data (mais recente)
            'type': 'video',  // Filtrar apenas vídeos
        }
    }).then(response => response.result.items);
}

// Função que busca vídeos de todos os canais veterinários selecionados e exibe na página
function getVideosDeCanaisVeterinarios() {
    // Array de Promises, uma para cada canal
    const promessas = canaisVeterinarios.map(canal => buscarVideosDoCanal(canal));

    // Quando todas as promessas resolverem (funcionou ou deu erro), junta todos os vídeos num array só
    Promise.all(promessas).then(resultados => {
        const todosVideos = resultados.flat(); // diminui o array

        // Exibir vídeos na página
        displayVideos(todosVideos);
    });
}

// Função para exibir vídeos no HTML
function displayVideos(videos) {
    const videoList = document.getElementById('video-list');
    videoList.innerHTML = '';  // Limpar a lista antes de adicionar os novos vídeos

    videos.forEach(video => {
        const title = video.snippet.title;
		const videoId = video.id.videoId;
        const cleanTitle = title.replace(/#[^\s#]+/g, '').trim(); //não exibirá as # dos vídeos nos títulos
        const videoUrl = `https://www.youtube.com/watch?v=${video.id.videoId}`; //cada vídeo tem seu próprio ID
		const thumbnail = video.snippet.thumbnails.medium.url;
        const publishedAt = new Date(video.snippet.publishedAt);
        const dataFormatada = publishedAt.toLocaleDateString('pt-BR');

        // Criando um item de lista para o vídeo
                const listItem = document.createElement('li');
        listItem.classList.add('video-item'); // para estilizar via CSS

        listItem.innerHTML = `
            <p class="video-title">${title}</p>
            <a href="${videoUrl}" target="_blank">
                <img src="${thumbnail}" alt="${title}">
            </a>
            <p class="video-date">${dataFormatada}</p>
        `;

        videoList.appendChild(listItem);
    });
}

// Função chamada quando a API é carregada
function start() {
    gapi.load('client', loadYouTubeAPI);
}

// Iniciar a API quando a página carregar
window.onload = start;


	/* ========================================================== */
	/*   Pagina de vacinação de Cão - Check das doses ADM         */
	/* ========================================================== */
function toggleCheck(button) {
  button.classList.toggle('checked');
  if (button.classList.contains('checked')) {
    button.innerHTML = '✔';
  } else {
    button.innerHTML = button.dataset.originalText || button.textContent;
  }
}
document.querySelectorAll("button").forEach(btn => {
  btn.dataset.originalText = btn.textContent;
});

function toggleCheck(button) {
  if (!button.classList.contains('checked')) {
    button.classList.add('checked');
    button.innerHTML = '✔';
  } else {
    button.classList.remove('checked');
    button.innerHTML = button.dataset.originalText;
  }
}


	/* ========================================================== */
	/*   Pagina de vacinação de Gato - Visualização das vacinas   */
	/* ========================================================== */
let vacinaModal;

document.addEventListener('DOMContentLoaded', function () {
  vacinaModal = new bootstrap.Modal(document.getElementById('vacinaModal'));
});

function abrirPopup(vacina, dose) {
  document.getElementById('vacinaNome').innerText = vacina;
  document.getElementById('vacinaDose').innerText = dose;
  vacinaModal.show();
}