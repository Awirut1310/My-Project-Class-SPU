<?php

session_start();
require 'config.php';
$minLength = 6;

if (isset($_POST['register'])) {
    $username = $_POST['username'] ?? ''; 
    $email = trim($_POST['email'] ?? '');  // ขจัดช่องว่างก่อนและหลัง hhhhhh
    $password = $_POST['password'] ?? '';
    $Confirmpassword = $_POST['confirm_password'] ?? '';
}

// ถ้าข้อมูลผิดพลาด ให้ redirect ไปยังหน้า register
if (empty($username)) {
    $_SESSION['error'] = "Please enter your username";
        header("location: ../index/register.php");
    exit();
} else if (empty($email)) {
    $_SESSION['error'] = "Please enter your email";
    header("Location: ../index/register.php");
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Please enter a valid email address";
    header("Location: ../index/register.php");
    exit();
} else if (strlen($password) < $minLength) {
    $_SESSION['error'] = "Please enter a valid password";
        header("location: ../index/register.php");
    exit();
} else if ($Confirmpassword !== $password) {
    $_SESSION['error'] = "Your passwords do not match";
        header("location: ../index/register.php");
    exit();
}
 else {
    // ตรวจสอบชื่อผู้ใช้
    $CheckUsername = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $CheckUsername->execute([$username]);
    $usernameExists = $CheckUsername->fetchColumn();

    // ตรวจสอบอีเมล
    $CheckEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $CheckEmail->execute([$email]);
    $userEmailExists = $CheckEmail->fetchColumn();

    if ($usernameExists) {
        $_SESSION['error'] = "Username already exists";
        header("location: ../index/register.php");
        exit();
    } else if ($userEmailExists) {
        $_SESSION['error'] = "Email already exists";
        header("location: ../index/register.php");
        exit();
    } else {
        // การแฮชรหัสผ่าน
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);

            $_SESSION['success'] = "Registration Successful!";
            header("location: ../index/login.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Something went wrong, please try again.";
            echo "Registration failed: " . $e->getMessage();
            header("location: ../index/register.php");
            exit();
        }
    }
}
?>
