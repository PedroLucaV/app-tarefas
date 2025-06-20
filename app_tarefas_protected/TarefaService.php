<?php

class TarefaService
{
    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa = null){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }
    public function inserir(){
        $query = 'INSERT INTO tb_tarefas (tarefa) VALUES (:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    public function  recuperar(){
        $query = 'SELECT 
                    t.id, s.status, t.tarefa 
                FROM 
                    tb_tarefas as t
                    left join tb_status as s on (t.id_status = s.id)';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar(){
    }

    public function excluir($id){
    }
}