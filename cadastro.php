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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h2>CADASTRO DE USUARIO</h2><br>
        <form action="" method="post">
            <div class="box2">
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
            </div>
        </form>
    </div>
    
    <?php
        if(isset($_POST['nome']))
        {
        
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
            {   


                $usuario->conectar("cadastrousuarioturma33","localhost","root","");

                if($usuario->msgErro == "")
                { 

                    if($senha == $confSenha)
                    {

                        if($usuario->cadastrar($nome, $telefone, $email, $senha))
                        { 
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
                            ?>
                            <div class="msg-erro">
                                <p>Email já cadastrado</p>
                            </div>
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                            <div class="msg-erro">
                                <p>Senha e Confirmar senha não conferem</p>
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$usuario->msgErro;?>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        <p>Preencha todos os campos.</p>
                    </div>
                <?php
            }
        }
    ?>
</body>
</html>