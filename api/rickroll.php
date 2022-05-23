<?php
$reverseDNS = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
$discord = false;

if(strpos($reverseDNS, "googleusercontent.com") || strpos($reverseDNS, "ptr.discord.com")) $discord = true; // Probably Discord.
if(!$discord) header("Location: https://youtube.com/watch?v=dQw4w9WgXcQ");

$url = "http://" . ($_GET["url"] ? preg_replace("/http(s?):\//", "", $_GET["url"]) : "cdn.discordapp.com/attachments/409300913262690326/948326675769348096/Courier.png?width=497&height=671");
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_exec($curl);

$mimeType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
curl_close($curl);

header("Content-Type: $mimeType");
echo file_get_contents($url);
