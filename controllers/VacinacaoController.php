<?php
require_once '../models/Vacinacao.php';
require_once '../models/Pet.php';

class VacinacaoController {

    // Listar vacinações
    public function listVacina() {
        $model = new Vacinacao();
        $vacinas = $model->listar();
        include '../views/vacinacao_list.php'; // Exibe os dados
    }

    // Cadastrar vacinação
    public function cadastrarVacina() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vacinacao = new Vacinacao();
            $data = $_POST['data'];
            $doses = $_POST['doses'];
            $id_vacina = $_POST['id_vacina'];
            $id_pet = $_POST['id_pet'];
            // Removido id_usuario

            if ($vacinacao->cadastrar($data, $doses, $id_vacina, $id_pet)) {
                header('Location: /projeto/vetz/list-vacinas');
                exit;
            } else {
                echo "Erro ao cadastrar a vacina.";
            }
        }
    }

    // Editar vacinação
    public function editar($id, $data, $doses, $id_vacina, $id_pet) {
        $model = new Vacinacao();
        $model->editar($id, $data, $doses, $id_vacina, $id_pet);
        header("Location: /projeto/vetz/list-vacinas");
        exit;
    }

    // Excluir vacinação
    public function excluir($id) {
        $model = new Vacinacao();
        $model->excluir($id);
        header("Location: /projeto/vetz/list-vacinas");
        exit;
    }

    // Buscar vacinação por ID (exibir para edição)
    public function buscarPorId($id) {
        $model = new Vacinacao();
        return $model->buscarPorId($id);
    }

    // Listar vacinas disponíveis
    public function listarVacinas() {
        $model = new Vacinacao();
        return $model->listarVacinas();
    }

    public function exibirFormulario() {
        $model = new Vacinacao();
        $vacinas = $model->listarVacinas();

        $pets = (new Pet())->listar(); // ou getAll(), dependendo do método no model Pet

        include '../views/vacinacao_form.php';
    }
}
