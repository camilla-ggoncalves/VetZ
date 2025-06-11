<?php
// Fluxo entre a model e a view

require_once '../models/Pet.php'; //Intermediador entre o BD e o PHP

class PetController {
    // Método para exibir o formulário de cadastro do pet
    public function showForm() {
        include '../views/pet_form.php'; // Inclua o arquivo do formulário
    }



    // Método para salvar o pet
    public function savePet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Está no método POST, ou seja, as informações obtidas no meu pet_form.php
            $pet = new Pet();
            $pet->nome = $_POST['nome'];

            $pet->raca = $_POST['raca'];
            $pet->idade = $_POST['idade'];
            $pet->porte = $_POST['porte'];
            $pet->peso = $_POST['peso'];
            $pet->sexo = $_POST['sexo'];

            $pet->imagem = $_FILES['imagem'];


            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $nomeImagem = uniqid() . '.' . $extensao;

            $caminhoDestino = __DIR__ . '/../uploads/' . $nomeImagem;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                $pet->imagem = $nomeImagem;
            } else {
                echo "Erro ao mover a imagem.";
                return;
            }
        } else {
            echo "Imagem não enviada.";
            return;
        }        

        // Salvar no banco
        if ($pet->save()) {
            header('Location: /projeto/vetz/list-pet');
            exit;
        } else {
            echo "Erro ao cadastrar o pet.";
        }
    }
}

    // Método para listar todos os pets
    public function listPet() {
        $pet = new Pet();
        $pets = $pet->getAll();
        include '../views/pet_list.php'; // essa função salvou os objetos que antes eram individuais em um só (pet -> pets). Depois foi incluído no pet_list, para os dados serem exibidos na tabela 
    }

    //Método para exibir o formulário de atualização
    public function showUpdateForm($id) { //pega do pet_list
        $pet = new Pet();
        $petInfo = $pet->getById($id);
        include '../views/update_pet.php'; // Inclua o arquivo do formulário de atualização
    }

    // Método para atualizar um pet
public function updatePet() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pet = new Pet();
        $pet->id = $_POST['id'];
        $pet->nome = $_POST['nome'];
        $pet->raca = $_POST['raca'];
        $pet->idade = $_POST['idade'];
        $pet->porte = $_POST['porte'];
        $pet->peso = $_POST['peso'];
        $pet->sexo = $_POST['sexo'];

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . '.' . $extensao;
    $caminhoDestino = __DIR__ . '/../uploads/' . $nomeImagem;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
        $pet->imagem = $nomeImagem;
    }

// Se não enviar nova imagem, não altera nada

            }
        } 
        

        if ($pet->update()) {
        header('Location: /projeto/vetz/list-pet'); //após atualização retorna novamente para a página de listagem

            exit;
        } else {
            echo "Erro ao atualizar o pet.";
        }
    }




// Método para excluir um pet pelo id
public function deletePetById() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pet = new Pet();
        $pet->id = $_POST['id'];

        // Chama o método 'delete()' da model
        if ($pet->delete()) { // Chama o método delete correto
            header('Location: projeto/vetz/list-pet'); // Redireciona após a exclusão
        } else {
            echo "Erro ao excluir o pet."; // Caso ocorra um erro
        }
    }
    }
}

