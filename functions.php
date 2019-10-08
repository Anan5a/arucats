<?php

define('SERVER_URI', 'http://localhost');
define('API_PATH', '/ocs/v1.php/apps/files_sharing/api/v1');
define('WEBDAV', '/remote.php/webdav/');

define('USER', 'fstest');
define('PASS', 'password009');

function validate($data)
{
    if (empty($data['url'])) {
        die('URL error!');
    }
    if (empty($data['fname'])) {
        die('File Name error!');
    }
    if (empty($data['pass'])) {
        die('Password error!');
    }
    if ($data['cat'] == '') {
        die('Category error!');
    }
    return;
}

function get_cat()
{
    return [
        'Movie',
        'Movie/Hollywood',
        'Movie/Bollywood',
        'Anime',
        'Anime/Hindi',
        'Adult',
        'Series',
        'Series/TV',
        'Series/WEB',
        'Foreign',
        'Others',
    ];
}

function check_folder($folder)
{

}

function check_file($file)
{

}

function create_folder($folder)
{

}

function create_download($url, $token)
{
    $url = escapeshellarg($url);
    $cmd = "wget -c $url -O /tmp/$token >/tmp/$token.wget 2>&1 ";
    shell_exec($cmd);
    return true;
}

function create_file($file, $bin_file, $token)
{
    #$token = sha1(random_bytes(12));
    $url = escapeshellarg(SERVER_URI.WEBDAV.$file);
    $cmd = "curl -# -u ".USER.":".PASS." -T $bin_file $url >/tmp/$token.curl 2>&1";

    shell_exec($cmd);
    unlink("/tmp/$token");
//    echo $cmd;
    return true;
}


function create_share($file, $pass, $token)
{
    $url = SERVER_URI.API_PATH;
    $cmd = "curl -u ".USER.':'.PASS." $url/shares --data 'path=$file&shareType=3&permissions=1&password=$pass'";
    $o = base64_encode(shell_exec($cmd));
    shell_exec("echo '$o' >/tmp/$token.ok");

}

function remote_data($url)
{

}

function parse_wget($path)
{
    $data = file_get_contents($path);
    $lines = explode("\n", $data);

    $reg_prog = '/(\d+K.*)/i';
    $reg_fin = '/\d+:\d+:\d+.*\((.*)\).*saved.*/i';
    $reg_start = '/Length: (.*).*\[(.*)\]/i';

    $prog = '';
    $len = '';
    $speed = '';
    $type = '';
    $status = '';

    foreach ($lines as $line) {
        if (preg_match_all($reg_start, $line, $match)) {
            $len = $match[1][0];
            $type = $match[2][0];
        }
        if (preg_match_all($reg_prog, $line, $match)) {
            $prog = str_replace(' ', '', $match[0]);
        }
        if (preg_match_all($reg_fin, $line, $match)) {
            $status = 'ok';
            $speed = $match[1][0];
        }
    }

    return [
        'status'=>$status,
        'speed'=>$speed,
        'prog'=>$prog,
        'len'=>$len,
        'type'=>$type,
    ];

}


function parse_curl($path)
{
    $data = file_get_contents($path);
    $lines = explode("\r", $data);
    return end($lines);
}



function parse_okd($path)
{
	$data = base64_decode(file_get_contents($path));
	$xml = simplexml_load_string($data);
	return $xml->data->token;

}


