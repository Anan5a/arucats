<?php

require __DIR__.'/functions.php';

$token = $_GET['id'] ?? null;

if(null == $token){
	die('TOKEN error');
}

$wg = "/tmp/$token.wget";
$cu = "/tmp/$token.curl";
$ok = "/tmp/$token.ok";

$wd = null;
$cd = null;
$okd = null;

if(!file_exists($wg)){
    die('Peoc not found!');
}

$wd = parse_wget($wg);
if(file_exists($cu)){
	$cd = parse_curl($cu);
}

if(file_exists($ok)){
	//finished!
	$okd = parse_okd($ok);
}
?>

<html>
<head>
<title>Tracker</title>
<meta name="viewport" content="width=device-width">
</head>
<body>
<h2>Remote upload Info</h2>

<h2>Download</h2>
<code><?php echo "Speed: $wd[speed] <br> Prog: ".$wd['prog'][0]; ?></code>

<h2>Upload</h2>
<code><?php echo substr($cd,30); ?></code>

<h2>Share</h2>
<?php
if(null !== $okd){
echo "<textarea>https://fstest.driveload.co/index.php/s/$okd</textarea>";
	//echo "<code></code>";
}else{

echo "<script>setTimeout(location.reload(true), 2000);</script><code>WAITING FOR DL/UP COMPLETE</code>";

}
