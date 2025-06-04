<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="">
        <meta name="description" content="">

        <title>VetZ</title>
        
        <!-- Loading Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading código CSS -->
        <link href="css/style.css" rel="stylesheet" media="screen and (color)">

        <!-- Awsome Fonts -->
        <link href="css/all.min.css" rel="stylesheet">

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
                                <li><a class="btn btn-menu" href="./perfil.html" role="button"><img class="imgperfil" src="images/perfil.svg"> SEU PERFIL</a></li>
                            </ul> 
                            
                        </div>
                    </nav>
                </div> 
            </nav>
        </header>
        <!--End Header-->

    <!-- --------------- CONTEÚDO DA PÁGINA ----------------->
    <section class="secUser">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($method === 'PUT')
            @method('PUT')
        @endif

        <!-- Campo Nome -->
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" 
                   value="{{ old('nome', $paciente->nome ?? '') }}" required>
        </div>

        <!-- Campo Raça -->
        <div>
            <label for="raca">Raça:</label>
            <input type="text" id="raca" name="raca" 
                   value="{{ old('raca', $paciente->raca ?? '') }}" required>
        </div>

        <!-- Campo Sexo -->
        <div>
            <label for="sexo">Sexo:</label>
            <input type="sexo" id="sexo" name="sexo" 
                   value="{{ old('sexo', $paciente->sexo ?? '') }}" required>
        </div>

        <!-- Campo Idade -->
        <div>
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" 
                   value="{{ old('idade', $paciente->idade ?? '') }}" required>
        </div>

        <!-- Campo Porte -->
        <div>
            <label for="porte">Porte:</label>
            <input type="number" id="porte" name="porte" 
                   value="{{ old('porte', $paciente->porte ?? '') }}" required>
        </div>

        <!-- Campo Peso -->
        <div>
            <label for="peso">Peso:</label>
            <input type="number" id="peso" name="peso" 
                   value="{{ old('peso', $paciente->peso ?? '') }}" required>
        </div>

        <!-- Campo Foto -->
        <div>
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">
            
            @if(isset($paciente) && $paciente->foto)
                <div>
                    <img src="{{ asset('storage/' . $paciente->foto) }}" 
                         width="100" alt="Foto atual do pet">
                </div>
            @endif
        </div>

        <!-- Botão de Submissão -->
        <button type="submit">{{ $buttonText }}</button>
    </form>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery.scrollTo-min.js"></script>
        <script src="js/jquery.nav.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>