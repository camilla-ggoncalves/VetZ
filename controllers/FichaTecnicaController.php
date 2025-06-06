<?php
// Fluxo entre a model e a view

require_once '../models/Pet.php'; //Intermediador entre o BD e o PHP

class FichaController {

    // Método para salvar o pet
    // Método para listar todos os pets
    public function listFicha() {
        $ficha = new Ficha();
        $fichas = $ficha->getAll();
        include '../views/recomendacoes.html'; // essa função salvou os objetos que antes eram individuais em um só (pet -> pets). Depois foi incluído no pet_list, para os dados serem exibidos na tabela 
    }

    //Método para exibir o formulário de atualização
    

}

