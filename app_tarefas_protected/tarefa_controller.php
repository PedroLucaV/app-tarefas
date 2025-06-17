<?php

require_once 'Conexao.php';
require_once 'Tarefa.php';
require_once 'TarefaService.php';

$acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao = 'recuperar';
$conexao = new Conexao();

if(isset($_GET["acao"]) && $_GET["acao"]=="inserir"){
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    header("Location:nova_tarefa.php?criada=1");
}else if($acao == 'recuperar'){
    $tarefaService = new TarefaService($conexao);
    $tarefas = $tarefaService->recuperar();
}else if(isset($_GET["acao"]) && $_GET["acao"]=="excluir"){
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $tarefaService = new TarefaService($conexao);
        $tarefas = $tarefaService->excluir($_GET['id']);
        header("Location:todas_tarefas.php");
    }
}