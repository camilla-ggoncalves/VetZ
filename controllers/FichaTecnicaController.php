<?php
// Fluxo entre a model e a view

require_once '../models/FichaTecnica.php'; //Intermediador entre o BD e o PHP

class FichaController {

  
    public function listFicha() {
        $ficha = new Ficha();
        $fichas = $ficha->getAll();
        include '../views/recomendacoes.php'; // essa função salvou os objetos que antes eram individuais em um só (pet -> pets). Depois foi incluído no pet_list, para os dados serem exibidos na tabela 
    }

    // Método para exibir o formulário de atualização
    

}

