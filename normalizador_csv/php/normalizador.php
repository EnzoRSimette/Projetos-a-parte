<?php
$caminho = $_FILES["arquivo"]["tmp_name"];
$caminho = str_replace('\\', '/', $caminho);

//? $$$$$$$$$$$$$$
//? $ PROTECTION $
//? $$$$$$$$$$$$$$

// $usr_psswd = [
//     ':usr' => $_POST['text_username'],
//     ':psswd' => $_POST['text_password']
// ];

// $comando = $ligacao->prepare("SELECT * FROM usuarios WHERE username = :usr AND password = :psswd");