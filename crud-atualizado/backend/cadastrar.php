<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['nome'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "usuario";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }

        $nome = trim($_POST['nome']);
        $login = trim($_POST['login']);
        $senha = md5($_POST['senha']);

        $insert = $pdo->prepare("INSERT INTO usuario (nome, login, senha) VALUES (:nome, :login, :senha)");
        $insert->bindParam(':nome', $nome);
        $insert->bindParam(':login', $login);
        $insert->bindParam(':senha', $senha);

        try {
            
            $insert->execute();
            echo 1;
            exit;
        } catch (PDOException $e) {
            echo 0; 
            exit;
        }
    }
} else {
    header('Location: ../index.php');
}
?>

