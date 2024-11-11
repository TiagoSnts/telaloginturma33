<?php
    Class Usuario
    {
        private $pdo;

        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;

            try
            {
                $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
            }
            catch(PDOException $erro)
            {
                $msgErro = $erro->getMessage();
            }
        }
        public function cadastrar($nome, $telefone, $email, $senha)
        {
            global $pdo;
        
            //verificar se o email ja esta cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :m");//:m significa que colocamos um apelido ma variável email do PHP
            $sql->bindValue(":m",$email);
            $sql->execute();

            //verificar se existe email cadastrado
            if($sql->rowCount() > 0)
            {
                return false;
            }
            else
            {
                //cadastrar usuario
                $sql = $pdo->prepare("INSERT INTO usuario (nome,telefone,email,senha) VALUES (:n,:t,:e,:s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }
        }
        public function logar($email,$senha)
        {
            global $pdo;

            $verificarEmail = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s");
            $verificarEmail->bindValue(":e", $email);
            $verificarEmail->bindValue(":s", md5($senha));
            $verificarEmail->execute();

            if($verificarEmail->rowCount()>0)
            {
                //posso logar no sistema, pois o email e a senha existe no bando de dados e estao de acordo
                $dados =  $verificarEmail->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                return true;
            }
            else
            {
                return false;
            }
        }
        public function listarUsuarios()
        {
            global $pdo;

            $sqlListar = $pdo->prepare("SELECT * FROM usuario");
            $sqlListar->execute();
            if($sqlListar->rowCount()>0)
            {
                $dados = $sqlListar->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            }
            else
            {
                return false;
            }
        }
        public function apagarUsuario($id)
        {
            global $pdo;
            
            $sqlapagar = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
            $sqlapagar->bindValue(":id",$id);
            return $sqlapagar->execute();
        }
        public function edicaoUsuario($id,$nome,$email,$telefone)
        {
            global $pdo;

            $sqleditar = $pdo->prepare("UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone WHERE id_usuario = :id");
            $sqleditar->bindValue(":nome",$nome);
            $sqleditar->bindValue(":email",$email);
            $sqleditar->bindValue(":telefone",$telefone);
            $sqleditar->bindValue(":id",$id);
            return $sqleditar->execute();
        }
    }
?>