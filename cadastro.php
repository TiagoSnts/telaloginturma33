<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
</head>
<body>
    <h2>CADASTRO DE USUARIO</h2><br>
    <form action="" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" id="" placeholder="Nome Completo"><br>

        <label>Email:</label><br>
        <input type="email" name="email" id="" placeholder="Digite o email"><br>

        <label>Telefone:</label><br>
        <input type="tel" name="telefone" id="" placeholder="Telefone Completo"><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" id="" placeholder="Digite sua Senha"><br>

        <label>Confirmar Senha:</label><br>
        <input type="password" name="confSenha" id="" placeholder="Confirme sua Senha"><br><br>

        <input type="submit" value="CADASTRAR">
    </form>
    
    <?php
        if(isset($_POST['nome']))
        {
            echo "passou aqui";
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha))
            {   


                $usuario->conectar("cadastrousuarioturma33","localhost","usuario","root","");

                if($usuario->msgErro == "")
                { echo "conectou no banco";
                    if($senha == $confSenha)
                    {echo "conectou no banco";

                        if($usuario->cadastrar($nome, $telefone, $email, $senha))
                        { echo "tentou cadastrar";
                            ?>
                                <!-- bloco de HTML -->
                                <div class="msg-sucesso">
                                    <p>Cadastrado com Sucesso</p>
                                    <p>Clique <a href="login.php">aqui</a>para logar.</p>
                                </div>
                            <?php
                        }
                        else
                        {
                            echo "tento outra vez".$usuario->msgErro;
                        }
                    }
                    else
                    {
                        echo "tento outra vez".$usuario->msgErro;
                    }
                }
                else
                {
                    echo "tento outra vez".$usuario->msgErro;
                }
            }
        }
    ?>
</body>
</html>