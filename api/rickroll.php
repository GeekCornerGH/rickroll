<?php
$reverseDNS = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
$discord = false;

if(strpos($reverseDNS, "googleusercontent.com") || strpos($reverseDNS, "ptr.discord.com")||str_includes("discord")) $discord = true; // Probably Discord.
if(!$discord) header("Location: https://youtube.com/watch?v=dQw4w9WgXcQ#rickroll.php");

$url = "http://" . ($_GET["url"] ? preg_replace("/http(s?):\//", "", $_GET["url"]) : "preview.redd.it/bllt4ulpwn671.png?width=960&crop=smart&auto=webp&s=485bb446bbe95eda5d660c45f0f69ce48f3993da");
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_exec($curl);

$mimeType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
curl_close($curl);

header("Content-Type: $mimeType");
echo file_get_contents($url);
