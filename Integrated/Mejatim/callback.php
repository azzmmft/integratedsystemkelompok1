<?php
// Konfigurasi Client ID dan Client Secret
$client_id = '1000.VWTFAKWB139A6452DTKCQB6FG439KD';
$client_secret = 'a3dc6853b48cc7c2958f75f78d9762f1a661c75343';
$redirect_uri = 'http://localhost/case-1-form-main/projek/callback.php'; // Redirect URI Anda

// Periksa apakah ada authorization code dari Zoho
if (isset($_GET['code'])) {
    $auth_code = $_GET['code'];

    // URL endpoint token Zoho
    $token_url = "https://accounts.zoho.com/oauth/v2/token";

    // Data yang dikirim ke Zoho untuk mendapatkan access token
    $post_data = [
        'code' => $auth_code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    // Kirim permintaan POST untuk mendapatkan access token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);

    // Periksa apakah ada access token
    if (isset($response_data['access_token'])) {
        $access_token = $response_data['access_token'];
        echo "Access Token Anda: " . $access_token;
    } else {
        echo "Gagal mendapatkan Access Token. Respon: " . $response;
    }
} else {
    echo "Authorization code tidak ditemukan!";
}
?>


