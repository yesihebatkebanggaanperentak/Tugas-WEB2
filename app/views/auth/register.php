<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<?php if(!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<?php if(!empty($success)) echo "<p style='color:green'>$success</p>"; ?>

<form method="POST">

    <label>Nama</label><br>
    <input type="text" name="nama"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <label>Konfirmasi Password</label><br>
    <input type="password" name="confirm_password"><br><br>

    <button type="submit">Daftar</button>

</form>

</body>
</html>