<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin MeJatim</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
    <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md bg-white p-8 shadow-lg rounded-lg w-full">
    <div class="font-bold mb-2 text-center text-lg" style="font-family: Poppins, sans-serif;">Login Admin MeJatim</div>
        <?php
            session_start();
            if (isset($_SESSION['error_message'])) {
                echo "<div class='mb-4 p-3 bg-red-100 text-red-700 rounded' style='font-family: Poppins, sans-serif;'>".$_SESSION['error_message']."</div>";
                unset($_SESSION['error_message']); // Hapus pesan error setelah ditampilkan
            }
        ?>
        <form id="loginForm" class="space-y-4" method="post" enctype="multipart/form-data" action="index.php" method="POST">
            <div>
                <label for="username" class="block mb-1" style="font-family: Poppins, sans-serif;">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" style="font-family: Poppins, sans-serif;" value="" required/>
            </div>
            <div>
                <label for="password" class="block mb-1" style="font-family: Poppins, sans-serif;">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" style="font-family: Poppins, sans-serif;" value="" required/>
            </div>
            <div class="g-recaptcha" data-sitekey="6Lfm7JAqAAAAAOLFMM8L9aQrGPJSBQm2bR8N2stV"></div>
                <button type="submit" value="Login" name="login" class="bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600" style="font-family: Poppins, sans-serif;">Login</button>
            </form>
        </div>
        </div>
    </body>    
</html>
