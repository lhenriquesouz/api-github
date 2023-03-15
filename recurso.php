<?php

require_once "db.php";

// Inicializando o cURL
$ch = curl_init();

if (!isset($_POST['user']) or empty($_POST['user'])){
  $erroPreenchimento = "Digite um usuário!!!";
} 

if (isset($_GET['favorite'])) {
  $id = $_GET['favorite'];
  $sql = "DELETE FROM favoritosGit WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':id', $id);
  $stmt->execute();
}

$user = $_POST['user'];

// Setando as configuração para o cURL
  curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.github.com/users/$user",
    CURLOPT_HTTPHEADER => ['Connection: keep-alive', 'Content-Type: application/json', 'User-Agent: lhenriquesouz'],
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_RETURNTRANSFER => true
  ]);

// Executa o cURL
$response = curl_exec($ch);

// Verifica erros
if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch) . "\n";
    exit;
}

// Decodifica a response JSON
$data = json_decode($response, true);

// Acesso aos dados da response
$username = $data["login"];
$avatar_url = $data["avatar_url"] ?? "https://us.123rf.com/450wm/yehorlisnyi/yehorlisnyi2104/yehorlisnyi210400016/yehorlisnyi210400016.jpg?ver=6";
$name = $data["name"];
$company = $data["company"];
$location = $data["location"];
$public_repos = $data["public_repos"];
$blog = $data["blog"] ?? "Não possui";
$created_at = date_format(new DateTime($data["created_at"]), "d/m/Y H:i:s");


// Fecha a sessão do cURL
curl_close($ch);