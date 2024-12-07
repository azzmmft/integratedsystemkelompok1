<?php
// Termasuk file token.php untuk mendapatkan access token
include('token.php');  // Mengambil access token dari token.php

// Periksa apakah form dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug untuk memeriksa data POST
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Mengambil data dari form
    $event_title = $_POST['event_title'];
    $event_description = $_POST['event_description'];
    $event_start = $_POST['event_start'];  // Format: yyyy-mm-ddThh:mm
    $event_end = $_POST['event_end'];      // Format: yyyy-mm-ddThh:mm

    // Endpoint API Zoho untuk menambah event ke kalender
    $calendar_id = "primary";  // Anda bisa menggunakan "primary" atau ID kalender yang sesuai
    $url = "https://www.zohoapis.com/calendar/v2/calendars/primary/events";

    // Menyiapkan data event yang akan dikirim
    $event_data = [
        "summary" => $event_title,
        "description" => $event_description,
        "start" => [
            "dateTime" => $event_start,
            "timeZone" => "Asia/Jakarta"
        ],
        "end" => [
            "dateTime" => $event_end,
            "timeZone" => "Asia/Jakarta"
        ]
    ];

    // Menggunakan cURL untuk melakukan request ke API Zoho
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $access_token",  // Gunakan access token yang disimpan
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($event_data));

    // Eksekusi cURL dan ambil response
    $response = curl_exec($ch);
    curl_close($ch);

    // Memeriksa apakah request berhasil
    if ($response === false) {
        echo "Error: " . curl_error($ch);  // Menampilkan error jika cURL gagal
    } else {
        $result = json_decode($response, true);
        if (isset($result['id'])) {
            echo "Event berhasil ditambahkan! Event ID: " . $result['id'];
        } else {
            echo "Gagal menambahkan event. Respon: " . $response;
        }
    }
} else {
    echo "Form belum dikirim dengan metode POST!";
}
?>
