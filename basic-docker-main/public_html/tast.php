<?php
// กำหนดค่าการเชื่อมต่อสำหรับ Docker
$host = "db"; // ชื่อ service ใน docker-compose.yml
$dbname = "sample_db";
$username = "admin";
$password = "1234";
$charset = "utf8mb4";

$dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

try {
    // สร้างการเชื่อมต่อ PDO
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "<h2 style='color: green;'>Connect Database Successfully!</h2>";

    // เรียกใช้ TitanicModel จากไฟล์ pdo.data.php
    require_once 'pdo.data.php';
    $model = new TitanicModel($pdo);
    $data = $model->getAll();

    echo "<pre>";
    print_r($data);
    echo "</pre>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Database Connection Failed!</h2>";
    echo "Error: " . htmlspecialchars($e->getMessage());
}