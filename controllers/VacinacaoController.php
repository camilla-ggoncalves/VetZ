<?php
require_once '../models/Vacinacao.php';

class VacinacaoController {

    // Listar vacinações
    public function listVacina() {
        $model = new Vacinacao();
        $vacinas = $model->listar();
        include '../views/vacinacao/vacinacao_list.php'; // Exibe os dados
    }

    // Cadastrar vacinação
    public function cadastrar($data, $doses, $id_vacina, $id_pet, $id_usuario) {
        $model = new Vacinacao();
        $model->cadastrar($data, $doses, $id_vacina, $id_pet, $id_usuario);
        header("Location: vacinacao_list.php"); // Redireciona após cadastrar
    }

    // Editar vacinação
    public function editar($id, $data, $doses, $id_vacina, $id_pet, $id_usuario) {
        $model = new Vacinacao();
        $model->editar($id, $data, $doses, $id_vacina, $id_pet, $id_usuario);
        header("Location: vacinacao_list.php"); // Redireciona após editar
    }

    // Excluir vacinação
    public function excluir($id) {
        $model = new Vacinacao();
        $model->excluir($id);
        header("Location: vacinacao_list.php"); // Redireciona após excluir
    }

    // Buscar vacinação por ID (exibir para edição)
    public function buscarPorId($id) {
        $model = new Vacinacao();
        return $model->buscarPorId($id);
    }
}
