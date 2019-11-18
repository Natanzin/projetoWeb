<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Projeto WEB</title>
    <script src="../bootstrap/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style>
        body{
            background: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="row">
            <div class="col" align="left">
                <a class="btn btn-outline-primary btn-sm" href="../index.php">Voltar</a>
                <h1>Plataforma de cursos</h1>
            </div>
            <div class="col text-center" align="right">
                <div class="card" style="background: none; width: 20rem; margin:0 auto; border: none;">
                    <div class="card-body">
                        <h6 class="card-title">ENTRAR</h6>
                        <div class="form-group">
                            <form action="cadastro_escola.php" method="POST">
                                <input required class="text-center form-control mb-2" type="text" name="email" id="email" placeholder="E-mail">
                                <input required class="text-center form-control mb-2" type="password" name="senha" id="senha" placeholder="Senha">
                                <input class="btn btn-success btn-sm" name="entrar" type="submit" value="Entrar"> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="background: none;">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col text-center" align="left" style="width: 50%; margin: 0 auto;">
                        <h3>Instituição de ensino</h3> 
                        <br><br><br>
                        <p> 
                            Cadastre a sua instituição agora mesmo para criar seus cursos em diversas áreas, podendo assim, mudar o mundo através do seu conhecimento. <br>
                            O seu conhecimento pode fazer a diferença na vida de pessoas do mundo inteiro. Cadastre-se e seja muito bem vindo!
                        </p><br><br>
                    </div>
                    <div class="col text-center" align="right" style="width: 50%;">
                        <h5>Cadastre sua instituição</h5>
                        <div class="card text-center" style="width: 22rem; margin: 0 auto; background: none;">
                            <div class="card-body">
                                <h6 class="card-title">CADASTRE-SE</h6> <br>
                                <form action="cadastro_escola.php" method="POST">
                                    <div class="form-group">
                                        <input required class="form-control text-center" type="text" name="nome" id="nome" placeholder="nome da instituição"> 
                                        <input required class="form-control text-center" type="email" name="email" id="email" placeholder="email da instituição"> 
                                        <input required class="form-control text-center" type="password" name="senha" id="senha" placeholder="insira a senha"> 
                                        <input required class="form-control text-center" type="password" name="confSenha" id="confSenha" placeholder="confirme a senha"> <br>
                                        <input class="form-control text-center btn btn-success btn-sm" name="cadastrar" type="submit" value="Cadastrar">
                                        <p style="font-size: 8px;">Ao clicar em Cadastrar, você concorda com nossos Termos de uso!</p>
                                    </div>                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>

    <?php  
        //pergunta se o botão cadastrar foi clicado
        if(isset($_POST['cadastrar'])){
            //realiza inserção no banco de dados.
            $nomeInstituição = $_POST['nome'];
            $emailInstituição = $_POST['email'];
            $senha = md5($_POST['senha']);
            $confSenha = md5($_POST['confSenha']);
            include_once "../DataBase/Conexao.php";
            if($senha == $confSenha){
                $sql = "insert into escola (nome_escola, email, senha) values ('$nomeInstituição','$emailInstituição','$senha')";
                $conexao->query($sql);
    ?>
                <script>
                    alert('Instituição cadastrada com sucesso!');
                    window.location.href "../index.php";
                </script>
    <?php
            }else{
    ?>
                <script>
                    alert('Senhas incompatíveis, favor repetir a operação!');
                    window.location.href "cadastro_escola.php";
                </script>
    <?php            
            }
        }
        
        //pergunta se o botão entrar foi clicado
        if(isset($_POST['submit'])){
            //realiza o login da instituição.
            $email = $_POST['email'];
            $senha = md5($_POST['senha']);

            $sqlLogin = "select * from escola where email='$email' and senha='$senha'";
            $result = $conexao->query($sql);
            $result = $result->fetchAll(2);
            echo "<pre>"; print_r($result); die;

            if(!$result){
                echo "
                    <script>
                        alert('E-mail ou senha incorretos. Favor repita a operação!');
                        window.location.href = '../index.php';
                    </script>
                ";
            }elseif ($login == $result[0]['email_user'] && $senha == $result[0]['senha_user']){
                $_SESSION['id_user'] = $result[0]['id_escola'];
                $_SESSION['nome'] = $result[0]['nome_escola'];
                $_SESSION['email'] = $result[0]['email'];
                $_SESSION['senha'] = $result[0]['senha'];
                header("location: ../telas/tela_inicial.php"); 
            }

            
        }
    ?>
    
</body>
</html>