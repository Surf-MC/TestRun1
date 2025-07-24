<?php
session_start();
require 'src/auth.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Use your Discord API credentials here
    $clientId = 'YOUR_DISCORD_CLIENT_ID';
    $clientSecret = 'YOUR_DISCORD_CLIENT_SECRET';
    $redirectUri = 'YOUR_REDIRECT_URI';

    // Step 1: Obtain access token
    $tokenUrl = "https://discord.com/api/oauth2/token";
    $tokenData = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirectUri,
        'scope' => 'identify'
    ];

    $ch = curl_init($tokenUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenData));

    $response = curl_exec($ch);
    curl_close($ch);
    $tokenInfo = json_decode($response);

    if (isset($tokenInfo->access_token)) {
        // Step 2: Fetch user info
        $userInfo = file_get_contents("https://discord.com/api/users/@me", false, stream_context_create([
            'http' => [
                'header' => "Authorization: Bearer {$tokenInfo->access_token}"
            ]
        ]));

        $discordUser = json_decode($userInfo);
        $discordId = $discordUser->id;

        // Link Discord account
        if (linkDiscord($discordId)) {
            echo "Discord account linked successfully!";
        } else {
            echo "Failed to link Discord account.";
        }
    } else {
        echo "Failed to obtain access token.";
    }
} else {
    echo "Authorization code not received.";
}
?>
