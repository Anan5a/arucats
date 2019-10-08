<?php
require __DIR__.'/functions.php';

if (!isset($_POST)) {
    die('Access not allowed!');
    exit;
}
$data = $_POST;

validate($data);

$filename = urlencode(str_replace('/','', $data['fname']));
$cat = get_cat()[$data['cat']];
$url = $data['url'];

$token = bin2hex(random_bytes(12));

$file = $cat.'/'.$filename;

$cmd = "php -r \" \\\$url = '$url'; \\\$file = '$file'; \\\$token = '$token'; require __DIR__.'/proc.php';\" &";
exec($cmd);
header('Location: t.php?id='.$token);
