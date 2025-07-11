<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <title>VetZ</title>
        
        <!-- Loading Bootstrap -->
        <link href="/projeto/VetZ/views/css/bootstrap.min.css" rel="stylesheet">
        <link href="/projeto/VetZ/views/css/style.css" rel="stylesheet" media="screen and (color)">
        <link href="/projeto/VetZ/views/css/all.min.css" rel="stylesheet">

        <!-- Favicon -->
        <link href="images/logoPNG.png" rel="shortcut icon">
    </head>

    <body>
        <!--Begin Header-->
        <header class="header">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <nav class="navbar navbar-expand-lg">
        
                        <a href="index.html" rel="home">
                            <img class="logomenu" src="images/Logo VETZ.svg" alt="VET Z" title="VetZ">
                        </a>
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <i class="fas fa-bars"></i>
                            </span>
                        </button>
        
                        <div class="navbar-collapse collapse" id="navbarCollapse">
                            <ul class="navbar-nav ml-auto 1  left-menu">
                                <li><a href="./index.html">HOME PAGE</a></li>
                                <li><a href="./sobreNOS.html">SOBRE NÓS</a></li>
                                <li><a href="./curiosidades.html">CURIOSIDADES</a></li>
                                <li><a href="./recomendacoes.html">RECOMENDAÇÕES</a></li>
                                <li><a href="./vacinacao.html">VACINAÇÃO</a></li>
                                <li><a class="btn btn-menu" href="./Login.html" role="button"><img class="imgperfil" src="images/perfil.svg"> SEU PERFIL</a></li>
                            </ul> 
                            
                        </div>
                    </nav>
                </div> 
            </nav>
        </header>
        <!--End Header-->



        <!-- --------------- CONTEÚDO DA PÁGINA ----------------->

 <!-- Conteúdo Principal -->
        <section class="section08" id="sec08">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
 <!-- Barra de Pesquisa -->
        <div class="group search-bar-vetz">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
            <input placeholder="Pesquisar" type="search" class="input">
        </div>

    <?php foreach ($fichas as $ficha): ?>
    <!-- <tr> Tabela de valor dentro de Book -->
        <td><?php echo $ficha['nome_comum']; ?></td>
        <td><img src="/projeto/VetZ/views/<?php echo ($ficha['imagem']); ?>" alt="Imagem do pet" width="150"></td>
         <?php endforeach; ?>
                
                <!-- Fim do cachorro animado -->

                    </div>
                </div>
            </div>
        </section>
    
        <!-- Begin footer-->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="footerp1">
                            Todos os direitos reservados <span id="footer-year"></span> © - VetZ </p>
                    </div>

                    <!-- <div class="col-md-1">
                        <p class="instagram">
                            <a><img href="#!" src="images/instagram.svg"></a>
                    </div>
                    <div class="col-md-1">
                        <p class="email">
                            <a><img href="#!" src="images/email.svg"></a>
                    </div> -->
                </div>
            </div>
        </div>
        <!--End footer-->


        <!-- Load JS =============================-->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery.scrollTo-min.js"></script>
        <script src="js/jquery.nav.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>