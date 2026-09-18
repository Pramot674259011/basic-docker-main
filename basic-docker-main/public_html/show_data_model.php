<?php
// Database Connection (ปรับ host เป็น "db" สำหรับ Docker Container)
$dsn = "mysql:host=db;dbname=sample_db;charset=utf8mb4";
$username = "admin";
$password = "1234";

try {
    // สร้าง PDO connection
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // เรียกใช้ Class Model (ลองเรียก pdo.data.php หรือ TitanicModel.php)
    if (file_exists('pdo.data.php')) {
        require_once 'pdo.data.php';
    } elseif (file_exists('TitanicModel.php')) {
        require_once 'TitanicModel.php';
    }

    $model = new TitanicModel($pdo);

    // ดึงข้อมูลทั้งหมดจาก Model
    $rows = $model->getAll();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titanic Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5 px-4">
        <h2 class="text-center mb-4">Titanic Passenger Data</h2>
        <?php if (!empty($rows)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Index</th>
                            <th>Passenger ID</th>
                            <th>Survived</th>
                            <th>Pclass</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Age</th>
                            <th>SibSp</th>
                            <th>Parch</th>
                            <th>Ticket</th>
                            <th>Fare</th>
                            <th>Cabin</th>
                            <th>Embarked</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td class="text-center"><?php echo htmlspecialchars($row['index'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['PassengerId'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['Survived'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['Pclass'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Name'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['Sex'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['Age'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['SibSp'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['Parch'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Ticket'] ?? ''); ?></td>
                                <td class="text-end"><?php echo htmlspecialchars($row['Fare'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Cabin'] ?? ''); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['Embarked'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">No records found in the Titanic table.</p>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>