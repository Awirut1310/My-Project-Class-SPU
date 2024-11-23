<?php 
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("location: ../index/login.php ");
    exit();  // หยุดการทำงานหากไม่มี session
}

$userData = null;  // กำหนดค่าเริ่มต้นให้กับ $userData

// ตรวจสอบว่า user_id ใน session มีค่า
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    try {
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        
        $userData = $stmt->fetch();

        // ถ้าไม่พบข้อมูลจากฐานข้อมูล
        if (!$userData) {
            echo "ไม่พบข้อมูลผู้ใช้";
            exit();  // หยุดการทำงานหากไม่พบข้อมูล
        }
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
        exit();  // หยุดการทำงานหากเกิดข้อผิดพลาด
    }
} else {
    echo "ไม่พบข้อมูล session";
    exit();  // หยุดการทำงานหากไม่มี session
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxify</title>
    <link rel="shortcut icon" type="x-icon" sizes="24x24" href="img/Taxify_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home-page.css">
</head>

<body>

<?php 
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            try {

                $stmt = $pdo->prepare("SELECT * FROm users WHERE id = ? ");
                $stmt->execute([$user_id]);
                $userData = $stmt->fetch();

            } catch (PDOException $e) {
                echo "Error " . $e->getMessage();
                exit();
            }
        }
        ?>
        <h1>Hi, <?php echo $userData['username'] ?> </h1>







    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>