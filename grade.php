<h1 style="margin:20px">Contatos</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped" style="top:40px;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Nasc.</th>
                <th>Sexo</th>
                <th><a style="padding:4px 10px" href="?controller=ContatosController&method=criar" class="btn btn-success btn-sm">Novo</a>
                    <a style="font-size:14px;padding:4px 11px;margin-left:0px;" class="btn btn-secondary" id="clear" href="index.php">Início</a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($contatos) {
                foreach ($contatos as $contato) {
                    ?>
                    <tr>
                        <td><?php echo $contato->nome; ?></td>
                        <td><?php echo $contato->telefone; ?></td>
                        <td><?php echo $contato->email; ?></td>
                        <td><?php echo $contato->cpf; ?></td>
                        <td><?php echo $contato->nasc; ?></td>
                        <td><?php echo $contato->gen; ?></td>
                        <td>
                            <a href="?controller=ContatosController&method=editar&id=<?php echo $contato->id; ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="?controller=ContatosController&method=excluir&id=<?php echo $contato->id; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">Nenhum registro encontrado</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>