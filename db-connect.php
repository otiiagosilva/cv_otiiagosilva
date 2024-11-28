<?php
// Configuração do banco de dados (arquivo config.php)
$config = [
    'host' => '166.1.227.180',
    'port' => 3306,
    'dbname' => 'default_db',
    'username' => 'gen_user',
    'password' => 'Ti703284@'
];

// Função para conectar ao banco de dados
function conectar_banco($config) {
    try {
        $dbh = new PDO('mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['dbname'],
            $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit;
    }
}

// Conectando ao banco de dados
$pdo = conectar_banco($config);

// Exemplo de consulta com prepared statement
try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome");
    $nome = 'João'; // Substitua por um nome válido
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultados) > 0) {
        foreach ($resultados as $row) {
            echo "ID: " . $row['id'] . ", Nome: " . $row['nome'] . "<br>";
        }
    } else {
        echo "Nenhum usuário encontrado.";
    }
} catch(PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
}
