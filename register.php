<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password dengan MD5

    // Cek apakah username sudah terdaftar
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
    } else {
        // Simpan data user ke database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <img src="images/logo.jpg" alt="Foto Kampus" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
            <h1 class="text-3xl font-bold text-blue-600 mt-4">APLIKASI ABSENSI BERBASIS WEB</h1>
        </div>

        <!-- Form Register -->
        <h2 class="text-2xl font-semibold mb-4 text-center">Daftar Akun</h2>
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
                <span class="text-gray-700">Lhat Kata Sandi</span>
            </label>
            <button type="submit" name="register" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 w-full">Buat Akun</button>
        </form>
        <p class="mt-4 text-center">Sudah punya akun? <a href="login.php" class="text-blue-500 hover:underline">Masuk ke Akun di sini</a>.</p>
    </div>
</body>
</html>
