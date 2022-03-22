<?php
    session_start();
    ob_start();
    include_once 'conectio.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/newCadastro.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="newCadDivPai">
        <div class="newCadDivfilho">
            <div class="newCadtitulo">
                <div>CADASTRE-SE</div>
                <div>X</div>
            </div>
            <div class="newCadForm">
                <div class="nomeCompleto">
                    <input type="text" name="nomeCompleto" id="nomeCompleto" placeholder="Nome completo">
                </div>
                <div class="dataNascimento">
                    <input type="date" name="dataNascimento" id="dataNascimento" placeholder="Data de Nascimento">
                </div>
                <div class="sexo">
                    <select name="sexo" id="sexo">
                        <option value="sexo">Sexo</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                    </select>
                </div>
                <div>
                    <select name="salinha" id="salinha">
                        <option value="salinha">Qual é sua salinha ?</option>
                        <option value="3a4">Sala de 03 a 4 Anos</option>
                        <option value="5a7">Sala de 05 a 7 Anos</option>
                        <option value="8a11">Sala de 08 a 11 Anos</option>
                    </select>
                </div>
                <div>
                    <select name="funcao" id="funcao">
                        <option value="funcao">Qual é sua função ?</option>
                        <option value="Professor">Professor</option>
                        <option value="Assistente">Assistente</option>
                        <option value="ADM">Administrativo</option>
                    </select>
                </div>
                <div class="login">
                    <input type="text" name="login" id="login" placeholder="Digite seu login:">
                </div>
                <div class="senha">
                    <input type="text" name="senha" id="senha" placeholder="Digite sua senha:">
                </div>
                <div class="repitaSenha">
                    <input type="text" name="repitaSenha" id="repitaSenha" placeholder="Repita sua senha:">
                </div>
            </div>
            <div>
                <input type="submit" value="CADASTRAR" name="newCad" design-bt="1">     
            </div>
        </div>
    </div>
</body>
</html>