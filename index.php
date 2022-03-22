<?php
    session_start();
    include_once 'conectio.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // $delmiroSenha = "a61f08cd680c773357b38c1147697f320c567d7b7f373ac65fd260790db3706f7f5e7bc5221c22cfb456da4d7bfcf2435a661ed69e84bd6ea80fbfe017d82c54";
    // $descriptografar = base64_decode($delmiroSenha);
    // echo $descriptografar;

    if(!empty($dados['loginesenha'])){
        //echo  password_hash('maciel@14', PASSWORD_DEFAULT);

        $login = $dados['usuario'];
        $email = $dados['usuario'];
        $departamento = $_POST['departamentos'];

        $quey = "SELECT m.mb_id, m.mb_Nome, m.mb_Sexo, m.mb_DataNasc, m.mb_Email, m.mb_img,
                    d.dp_id, d.dp_Nome, d.dp_Sala, d.dp_Funcao, d.mb_id as dpMebroId,
                    u.usu_id, u.usu_Login, u.usu_Senha as senha, u.mb_id as usuMembroId 
                    FROM membro as m, departamento as d, usuario as u
                    WHERE m.mb_id = d.mb_id
                    AND m.mb_id = u.mb_id
                    AND (u.usu_Login =:user OR m.mb_Email =:email)
                    LIMIT 1";

            $resultUsuario = $conn->prepare($quey);
            $resultUsuario->bindValue(":user",$login);
            $resultUsuario->bindValue(":email",$email);
            $resultUsuario->execute();
            $qtde = $resultUsuario->rowCount();

            if($departamento > 0){
                if( ( $resultUsuario->rowCount() ) != 0 ){
                    $row_usuario = $resultUsuario->fetch(PDO::FETCH_ASSOC);
                    if( password_verify( $dados['senha'], $row_usuario['senha'] ) ){ //utilizando o password_verify para ver se a senha digitada e igual a senha na BD
                       //header("Location: home.php");
                    }else{
                        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usúario ou Senha inválida !</p>";
                     }
     
                }else{
                    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usúario ou Senha inválida !</p>";
                }
            }else{
                
                echo '<p>Escolha o seu Departamento !</p>';
            }

            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/indexMobile.css">
    <title>D.I Verbo da Vida Ibura</title>
</head>
<body>
    <?php
    //exemplo de criptografia de senha com php
     // echo  password_hash('ellen123', PASSWORD_DEFAULT);
    ?>
        <!-- <div id="screeshotPC"> <h1>Site disponivel apenas para Mobile</h1> </div> -->
            <div id="container">
                <div boxFilho="1">                    
                    <form action="" method="POST">

                        <div id="containerLogin">

                            <div id="containerHeader">
                                <div class="imgem"> <img src="img/logoverbinhoibura.svg" alt="" sizes="" srcset=""> </div>
                                <!-- <div class="titulo"> <b>Bem vindo ao app do Verbinho &#128512;</b> </div> -->
                            </div>

                            <!-- <div class="tituloHome">
                                <h2>Bem vindo ao app do Verbinho &#128512;</h2>
                            </div> -->

                           <div id="containerBody">

                                <div id="loginCampo" class="standardStyle">
                                    <input type="text" name="usuario" id="usuario" placeholder="Nome de Usuário ou E-mail">
                                </div>

                                <div id="senhaCampo" class="standardStyle">
                                    <input type="password" name="senha" id="senha" placeholder="Senha">
                                </div>

                                <div id="departamentoCampo" class="standardStyle">
                                    <select name="departamentos">
                                        <option value="0">Qual o Seu departamento ?</option>
                                        <option value="1">Salinha 3 a 4 Ano</option>
                                        <option value="2">Salinha 5 a 7 Ano</option>
                                        <option value="3">Salinha 8 a 11 Ano</option>
                                        <option value="4">Salinhas Gerais ADM</option>
                                    </select>
                                </div>

                                <div id="botaoCampo">
                                    <input type="submit" value="ENTRAR" name="loginesenha" design-bt="1"> 
                                </div>

                           </div>

                           <div id="containerFoot">
                            
                                <div id="cadastreseCampo">
                                    <a href="newCadastro.php"  >Cadastre-se</a>
                                </div>

                                <div id="esqueciSenha">
                                    <a href="esqueciSenha.php">Esqueceu a senha ? </a>
                                </div>

                           </div>

                        </div>

                    </form>

                </div>

                <div boxFilho="2">
                    <div>你會知道真相，它會讓你自由</div>
                    <div>criado por <b>Brother'startUp</b></div>
                </div>

            </div>
</body>
</html>