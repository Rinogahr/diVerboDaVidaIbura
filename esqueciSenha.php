<?php
    session_start();
    ob_start();
    include_once 'conectio.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'libe/vendor/autoload.php';
    $mail = new PHPMailer(true);
    

    

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(!empty($dados['SendRecuperarSenha'])){

        $email = $dados['usuario'];
        $departamento = $_POST['usuario'];
        
        if($departamento){
            $quey = "SELECT m.mb_id, m.mb_Nome, m.mb_Sexo, m.mb_DataNasc, m.mb_Email, m.mb_img,
                        d.dp_id, d.dp_Nome, d.dp_Sala, d.dp_Funcao, d.mb_id as dpMebroId,
                        u.usu_id, u.usu_Login, u.mb_id as usuMembroId 
                        FROM membro as m, departamento as d, usuario as u
                        WHERE m.mb_id = d.mb_id
                        AND m.mb_id = u.mb_id
                        AND  m.mb_Email =:email
                  LIMIT 1";

            $resultUsuario = $conn->prepare($quey);
            $resultUsuario->bindValue(":email",$email);
            $resultUsuario->execute();
            $qtde = $resultUsuario->rowCount();
            if( ( $resultUsuario->rowCount() ) != 0 ){
                
               $linhaUsuario = $resultUsuario->fetch(PDO::FETCH_ASSOC);
               $chaveRecupSenha = password_hash($linhaUsuario['mb_id'], PASSWORD_DEFAULT);
               $link = "http://localhost/verboiburadi/atualizaSenha.php?key=$chaveRecupSenha";

            $queryUpdateUser =   "UPDATE usuario
                                  SET usu_recupSenha = :recupSenha
                                  WHERE usu_id = :usuId
                                  LIMIT 1";
            $resultUpdateUser = $conn->prepare($queryUpdateUser);
            $resultUpdateUser->bindParam(':recupSenha', $chaveRecupSenha, PDO::PARAM_STR);    
            $resultUpdateUser->bindParam(':usuId', $linhaUsuario['mb_id'], PDO::PARAM_STR);  
            
            if( $resultUpdateUser->execute() ){
                try {
                    
                        //Server settings
                        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                         //Ativar saída de depuração detalhada
                        $mail->CharSet = 'UTF-8';
                        $mail->isSMTP();                                              //Enviar usando SMTP
                        $mail->Host       = 'smtp.mailtrap.io';                      //Defina o servidor SMTP para enviar
                        $mail->SMTPAuth   = true;                                   //Habilitar autenticação SMTP
                        $mail->Username   = '8f9b74cfbd3d4e';                      //Nome de usuário SMTP
                        $mail->Password   = '1ef06c8b21a348';                     //Senha SMTP
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Ativar criptografia TLS implícita
                        $mail->Port       = 2525;                               //Porta TCP para conexão; use 587 se você definiu `SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS`
                    
                        //Recipients
                        $mail->setFrom('programerbt@gmail.com', 'Adm Verbo Ibura D.I');
                        $mail->addAddress($email, $linhaUsuario['mb_Nome']);     //Adicionar um destinatário
                        //$mail->addAddress('ellen@example.com');               //O nome é opcional
                        //$mail->addReplyTo('info@example.com', 'Information');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');
                    
                        //Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Adicionar Anexos
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Nome opcional
                    
                        //Content
                        $mail->isHTML(true);                                  //Definir formato de e-mail para HTML
                        $mail->Subject = 'Recuperar a senha';
                        $mail->Body    = 'Prezado ' . $linhaUsuario['mb_Nome'] . ".<br> 
                        Foi solicitado uma alteração de sua senha de acesso ao App do verbinho.
                        <br><br> Para continuar o procedimento,  clique no link abaixo<br><br>". "<a href='$link'  > Recuperar minha senha ! </a>".
                        "<br><br> caso não tenha solicitado a alteração da senha ignore esse e-mail, sua senha continuará o mesmo";

                        $mail->AltBody = 'Prezado ' . $linhaUsuario['mb_Nome'] . ".\n\n Foi solicitado uma alteração de sua senha de acesso ao App do verbinho.
                        \n\n Para continuar o procedimento,  copie o link abaixo e cole no seu navegador em seguida dê enter\n\n". $link .
                        "\n\n caso não tenha solicitado a alteração da senha ignore esse e-mail, sua senha continuará o mesmo";
                    
                        $mail->send();
                        $_SESSION['msg'] = "<p style='color: #007d20'>E-mail com instruções para alteração de senha enviado para</p> $email";
                } catch (Exception $e) {
                    echo "Error e-mail não enviado !. Mailer Error: {$mail->ErrorInfo}";
                }
            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Tente novamente !</p>";
            }

                
            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: E-mail não cadastrado !</p>";
            }


            
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Por favor preencha com um e-mail valido !</p>";

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
    <title>Recuperar Senha</title>
</head>
<body>
    <div id="paiDivLogin">
        <form action="" method="POST">
            <div id="filhoDivLogin">
                <div class="imgLogo">
                    <img src="img/logoverbinhoibura.svg" alt="" sizes="" srcset="">
                </div>

                <div class="tituloHome">
                    <h1>Recuperar Senha</h1>
                </div>

                <div id="loginCampo" class="standardStyle">
                    <input type="text" name="usuario" id="usuario" placeholder="Informe o seu E-mail Cadastrado">
                </div>

                <div id="botaoCampo">
                        <input type="submit" value="RECUPERAR" name="SendRecuperarSenha" design-bt="1"> 
                </div>
            </div>                    
        </form>   
     </div>
</body>
</html>