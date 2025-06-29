<?php
$acao = 'recuperarPendentes';
require_once 'tarefa_controller.php';
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script>
            const editar = (id, txt_tarefa) => {
                const form = document.createElement('form');
                form.action = 'tarefa_controller.php?acao=atualizar&rota=pend';
                form.method = 'post';
                form.className = 'row';

                const inputTarefa = document.createElement('input');
                inputTarefa.type = 'text';
                inputTarefa.name = 'tarefa';
                inputTarefa.class = 'form-control col-9';
                inputTarefa.value =  txt_tarefa
                form.appendChild(inputTarefa);

                let inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'id';
                inputId.value = id;
                form.appendChild(inputId)

                const button = document.createElement('button');
                button.type = 'submit';
                button.className = 'btn col-3 btn-info'
                button.textContent = 'Atualizar'
                form.appendChild(button);

                let tarefa = document.getElementById(`tarefa_${id}`)

                tarefa.textContent = '';

                tarefa.insertBefore(form, tarefa[0])
            }

            const remover = (id) => {
                location.href = 'todas_tarefas.php?acao=remover&id='+id+'&rota=pend';
            }

            const marcarRealizada = (id) =>{
                location.href = 'todas_tarefas.php?acao=marcarRealizada&id='+id;
            }
        </script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>
        <?php if(isset($_GET['atualizada']) && $_GET['atualizada'] == 0){ ?>
            <div class="bg-danger pt-2 text-white d-flex justify-content-center">
                <h5>Erro ao Atualizar a Tarefa</h5>
            </div>
        <?php }?>
        <?php if(isset($_GET['atualizada']) && $_GET['atualizada'] == 1){ ?>
            <div class="bg-success pt-2 text-white d-flex justify-content-center">
                <h5>Tarefa Atualizada com Sucesso!</h5>
            </div>
        <?php }?>
        <?php if(isset($_GET['atualizada']) && $_GET['atualizada'] == 2){ ?>
            <div class="bg-primary pt-2 text-white d-flex justify-content-center">
                <h5>Tarefa Removida com Sucesso!</h5>
            </div>
        <?php }?>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

                                <?php foreach ($tarefas as $tarefa){
                                    $titulo = $tarefa['tarefa'];
                                    $status = $tarefa['status'];
                                    $id = $tarefa['id'];
                                    ?>
                                    <div class="row mb-3 d-flex align-items-center tarefa">
                                        <div class="col-sm-9" id="tarefa_<?=$id?>"><?= $titulo?> (<?= $status?>)</div>
                                        <div class="col-sm-3 mt-2 d-flex justify-content-between">
                                            <i onclick="remover(<?=$id?>)" class="fas fa-trash-alt fa-lg text-danger"></i>
                                            <?php if($status == 'pendente'){?>
                                                <i onclick="editar(<?=$id?>, '<?= $titulo?>')" class="fas fa-edit fa-lg text-info"></i>
                                                <i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?=$id?>)"></i>
                                            <?php }?>
                                        </div>
                                    </div>
                                <?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>