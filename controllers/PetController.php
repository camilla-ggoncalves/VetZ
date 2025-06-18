<?php
require_once '../models/Pet.php';

class PetController {
    public function showForm() {
        include '../views/pet_form.php';
    }

    public function savePet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pet = new Pet();
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
                } else {
                    echo "Erro ao mover a imagem.";
                    return;
                }
            } else {
                echo "Imagem não enviada.";
                return;
            }

            if ($pet->save()) {
                header('Location: /projeto/vetz/list-pet');
                exit;
            } else {
                echo "Erro ao cadastrar o pet.";
            }
        }
    }

    public function listPet() {
        $pet = new Pet();
        $pets = $pet->getAll();
        include '../views/pet_list.php';
    }

    public function showUpdateForm($id) {
        $petModel = new Pet();
        $pet = $petModel->getById($id);

        if ($pet) {
            include '../views/update_pet.php';
        } else {
            echo "Pet não encontrado.";
        }
    }

    public function updatePet() {
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
    } else {
        $pet->imagem = ''; // Mantenha imagem atual se não enviar nova
    }

    if ($pet->update()) {
        header('Location: /projeto/vetz/list-pet');
        exit;
    } else {
        echo "Erro ao atualizar o pet.";
    }
}


    public function deletePetById($id = null) {
    if ($id) {
        $pet = new Pet();
        $pet->id = $id;

        if ($pet->delete()) {
            header('Location: /projeto/vetz/list-pet');
            exit;
        } else {
            echo "Erro ao excluir o pet.";
        }
    } else {
        echo "ID não fornecido para exclusão.";
    }
    }
    public function listarPets() {
        $model = new Pet();
        return $model->listar();  // O método listar do model retorna array dos pets
    }
}
    
    
