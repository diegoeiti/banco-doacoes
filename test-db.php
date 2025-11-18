<?php
$host = 'doacoes-mysql-293859b3-crud-fullstack.k.aivencloud.com';
$port = 27167;
$dbname = 'defaultdb';
$username = 'avnadmin';
$password = 'AVNS_syqRwdFcCrJM4h3kic7';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, [
    PDO::MYSQL_ATTR_SSL_CA => true
  ]);
  echo "✅ Conexão com Aiven MySQL bem-sucedida!\n";

  // Testar se consegue listar tabelas
  $stmt = $pdo->query("SHOW TABLES");
  $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
  echo "📊 Tabelas encontradas: " . count($tables) . "\n";
} catch (PDOException $e) {
  echo "❌ Erro de conexão: " . $e->getMessage() . "\n";
}
