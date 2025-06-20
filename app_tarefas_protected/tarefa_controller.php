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
}else if(isset($_GET["acao"]) && $_GET["acao"]=="atualizar"){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $return = $tarefaservice->atualizar();
    if($return){
        header("Location:todas_tarefas.php?atualizada=1");
    }else{
        header("Location:todas_tarefas.php?atualizada=0");
    }
}