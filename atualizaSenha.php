<?php
    session_start();
    ob_start();
    include_once 'conectio.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $recupSenha ='';
    $usuId = ''; 

    $key = filter_input(INPUT_GET, 'key', FILTER_DEFAULT);
    echo "chave do usuário -> var_dump($key)";

    if(!empty($key)){
        $quey = "SELECT u.usu_id, u.usu_Login, u.mb_id as usuMembroId, usu_recupSenha 
                FROM usuario as u
                WHERE usu_recupSenha = :usu_recupSenha
            LIMIT 1";
            $resultUsuario = $conn->prepare($quey);
            $resultUsuario->bindValue(":usu_recupSenha",$key, PDO::PARAM_STR);
            $resultUsuario->execute();
            $qtde = $resultUsuario->rowCount();

            if( ( $resultUsuario->rowCount() ) != 0 ){
                $row_usuario = $resultUsuario->fetch(PDO::FETCH_ASSOC);
                var_dump($row_usuario);
                $usuId = $row_usuario["usu_id"];
                $recupSenha = $row_usuario["usu_recupSenha"];

            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Link Invalido !</p>";
                header("Location: esqueciSenha.php");
            }

            
    }else{
        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Link Invalido !</p>";
        header("Location: esqueciSenha.php");
    }
    
    if(!empty($dados['atualizarSenha'])){
        $newSenha = $_POST['newSenha'];
        $passwordRepeat = $_POST['passwordRepeat'];

        if( ( $newSenha == '' ) && ($passwordRepeat == '' )){
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Preencha todos os campos !</p>";
        }else{
            if( ( $newSenha === $passwordRepeat ) ){
                $novaSenha = password_hash($newSenha, PASSWORD_DEFAULT);
                $recuperarSenhaNull = 'NULL';
                var_dump($recupSenha);
                var_dump($usuId);
                $newQuery = "UPDATE 
                                usuario
                            SET
                                usu_Senha =:senhaNova,
                                usu_recupSenha =:recuperarSenhaNull 
                            WHERE 
                                usu_id =:IdUsu
                            AND
                                usu_recupSenha =:recSenha";
                 $resUpSenha = $conn->prepare($newQuery);
                 $resUpSenha->bindValue(":senhaNova",$novaSenha);
                 $resUpSenha->bindValue(":IdUsu",$usuId);
                 $resUpSenha->bindValue(":recSenha",$recupSenha);
                 $resUpSenha->bindValue(":recuperarSenhaNull",$recuperarSenhaNull);
                 $resUpSenha->execute();
                 $qtde = $resUpSenha->rowCount();
                 
                 if( $qtde != 0 ){
                    var_dump($resUpSenha);
                 }else{
                    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: erra-se rodrigo !</p>";
                 }


                $_SESSION['msg'] = "<p style='color: #0000ff'>entrou no if !</p>";
            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: as Senhas não estão iguais !</p>";
            }
        }

        
    }


    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
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
    <title>Atualizar a Senha</title>
</head>
<body>
    <div id="paiDivLogin">
        <form action="" method="POST">
            <div id="filhoDivLogin">
                <div class="imgLogo">
                    <img src="img/logoverbinhoibura.svg" alt="" sizes="" srcset="">
                </div>

                <div class="tituloHome">
                    <h1>Atualizar a Senha</h1>
                </div>

                <div id="senhaCampo" class="standardStyle">
                    <input type="password" name="newSenha" id="newSenha" placeholder="Informe a nova senha">
                </div>
                <div id="senhaCampo" class="standardStyle">
                    <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Repita a nova senha">
                </div>

                <div id="botaoCampo">
                        <input type="submit" value="ATUALIZAR" name="atualizarSenha" design-bt="1"> 
                </div>
            </div>                    
        </form>   
     </div>
</body>
</html>