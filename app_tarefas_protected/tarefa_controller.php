<?php

require_once 'Conexao.php';
require_once 'Tarefa.php';
require_once 'TarefaService.php';

$acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao;
$conexao = new Conexao();

if($acao=="inserir"){
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    header("Location:nova_tarefa.php?criada=1");
}else if($acao == 'recuperar'){
    $tarefaService = new TarefaService($conexao);
    $tarefas = $tarefaService->recuperar();
}else if($acao == "atualizar"){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $return = $tarefaservice->atualizar();
    if($return){
        header("Location:todas_tarefas.php?atualizada=1");
    }if($return && isset($_GET['rota'])){
        header("Location:index.php?atualizada=1");
    }else{
        header("Location:todas_tarefas.php?atualizada=0");
    }
}else if($acao == "remover"){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefaservice = new TarefaService($conexao, $tarefa);
    $return = $tarefaservice->excluir();
    if($return){
        header("Location:todas_tarefas.php?atualizada=2");
    }else if($return && isset($_GET['rota'])){
        header("Location:index.php?atualizada=2");
    }else{
        header("Location:todas_tarefas.php?atualizada=0");
    }
}else if($acao == 'marcarRealizada'){
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);

    $tarefaService = new TarefaService($conexao, $tarefa);
    $return = $tarefaService->marcarRealizada();
    if($return){
        header("Location:todas_tarefas.php?atualizada=1");
    }else{
        header("Location:todas_tarefas.php?atualizada=0");
    }
}else if($acao == 'recuperarPendentes'){
    $tarefaService = new TarefaService($conexao);
    $tarefas = $tarefaService->recuperarPendentes();
}