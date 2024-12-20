<?php
// Gantilah dengan authorization code yang Anda dapatkan dari Zoho
$authorization_code = "1000.5220a7775d05aba55bbd5f38dd635db7.26f855d4140dcd3dadac45846aca4e86";

// Data untuk mendapatkan token
$client_id = "1000.VWTFAKWB139A6452DTKCQB6FG439KD";
$client_secret = "a3dc6853b48cc7c2958f75f78d9762f1a661c75343";
$redirect_uri = "http://localhost/case-1-form-main/projek/get_and_save_token.php";  // Sesuaikan dengan redirect URI Anda

// URL untuk mendapatkan access token dari Zoho
$token_url = "https://accounts.zoho.com/oauth/v2/token";

// Data untuk POST ke endpoint Zoho
$data = [
    'code' => $authorization_code,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'grant_type' => 'authorization_code'
];

// Inisialisasi cURL untuk mendapatkan token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Eksekusi cURL dan ambil response
$response = curl_exec($ch);
curl_close($ch);

// Periksa apakah ada error
if ($response === false) {
    echo "Error: " . curl_error($ch);
    exit;
}

// Decode JSON response untuk mengambil token
$response_data = json_decode($response, true);

// Periksa apakah access token ada di response
if (isset($response_data['access_token'])) {
    $access_token = $response_data['access_token'];
    $refresh_token = isset($response_data['refresh_token']) ? $response_data['refresh_token'] : null;
    
    // Menyimpan token dalam file PHP
    $token_file_content = '<?php' . "\n";
    $token_file_content .= '$access_token = "' . $access_token . '";' . "\n";
    if ($refresh_token) {
        $token_file_content .= '$refresh_token = "' . $refresh_token . '";' . "\n";
    }
    $token_file_content .= '?>';

    // Menyimpan file PHP yang berisi token
    file_put_contents('token.php', $token_file_content);

    echo "Token berhasil disimpan!";
} else {
    echo "Gagal mendapatkan Access Token. Respon: " . $response;
}
?>
