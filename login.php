<?php
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password dengan MD5

    // Cek kredensial pengguna
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("showPassword");
            passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto my-6 px-4">
        <!-- Foto Profil Kampus -->
        <div class="text-center mb-6">
            <img src="images/logo.jpg" alt="Foto Kampus" class="w-24 h-24 sm:w-32 sm:h-32 mx-auto rounded-full object-cover shadow-md">
            <h1 class="text-2xl sm:text-3xl font-bold text-blue-600 mt-4">APLIKASI ABSENSI BERBASIS WEB</h1>
        </div>

        <!-- Form Login -->
        <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-center">Masuk</h2>
        <form action="" method="post" class="bg-white p-4 sm:p-6 rounded-lg shadow-md max-w-md mx-auto">
            <label class="block mb-4">
                <span class="text-gray-700">Nama Pengguna</span>
                <input type="text" name="username" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300" />
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">Kata Sandi</span>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300" />
            </label>
            <label class="inline-flex items-center mb-4">
                <input type="checkbox" id="showPassword" onclick="togglePassword()" class="mr-2">
                <span class="text-gray-700">Lihat Kata Sandi</span>
            </label>
            <button type="submit" name="login" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-full">Login</button>
        </form>
        <p class="mt-4 text-center">Belum punya akun? <a href="register.php" class="text-blue-500 hover:underline">Daftar di sini</a>.</p>
    </div>
</body>
</html>
