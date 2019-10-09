<?php
require __DIR__.'/functions.php';

if (!isset($_POST)) {
    die('Access not allowed!');
    exit;
}
$data = $_POST;

validate($data);

$filename = (str_replace(['/',' '],['','_'], $data['fname']));
$cat = get_cat()[$data['cat']];
$url = $data['url'];
$pass = $data['pass'];

$token = bin2hex(random_bytes(12));

$file = $cat.'/'.$filename;

$cmd = "php -r \" \\\$url = '$url'; \\\$file = '$file'; \\\$token = '$token'; \\\$pass = '$pass'; require __DIR__.'/proc.php';\"";
#var_dump($cmd.' >/dev/null 2>&1 &');
exec($cmd.' >/dev/null 2>&1 &');
header('Location: t.php?id='.$token);
echo "<a href='t.php?id=$token'>Copy this link</a>";
exit;
