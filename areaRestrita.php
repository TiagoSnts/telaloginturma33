<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastrousuarioturma33","localhost","root","");

    $dados = $usuario->listarUsuarios();

    if(isset($_GET['action']) && isset ($_GET['id']))
    {
        $id = $_GET['id'];
        
        if ($_GET['action'] == 'delete')
        {
            $usuario->apagarUsuario($id);
            header("Location: areaRestrita.php");
        } 
        elseif($_GET['action'] == 'edit')
        {
            if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']))
            {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];

                $usuario->edicaoUsuario($id,$nome,$email,$telefone);
                header("Location: areaRestrita.php");
                exit;
            }
            else
            {
                $dadosUsuario = null;
                foreach ($dados as $pessoa)
                {
                    if ($pessoa['id_usuario'] == $id)
                    {
                        $dadosUsuario = $pessoa;
                        break;
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area de edição e exclusão</title>
</head>
<body>
    <h1>Listagem de Usuarios</h1>
    <?php if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($dadosUsuario)):?>
    <h2>Editar Usuário</h2>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $dadosUsuario['nome'];?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $dadosUsuario['email'];?>" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?php echo $dadosUsuario['telefone'];?>" required><br>

        <input type="submit" value="Salvar mudanças">
    </form>
<?php endif;?>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Edições</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($dados))
                {
                    foreach($dados as $pessoa):
            ?>
                <tr>
                    <td><?php echo $pessoa['nome'];?></td>
                    <td><?php echo $pessoa['email'];?></td>
                    <td><?php echo $pessoa['telefone'];?></td>
                    <td>
                        <a href="areaRestrita.php?action=edit&id=<?php echo $pessoa ['id_usuario'];?>">Editar</a>
                        <a href="areaRestrita.php?action=delete&id=<?php echo $pessoa['id_usuario'];?>" onclick="return confirm ('Tem certeza que deseja excluir este usuario?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach;
        } else { ?>
            <tr>
                <td colspan="4">Nenhum usuário cadastrado.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>