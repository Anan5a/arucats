<?php

define('SERVER_URI', 'https://localhost');
define('API_PATH', '/ocs/v1.php/apps/files_sharing/api/v1');
define('WEBDAV', '/remote.php/webdav/');

define('USER', 'fstest');
define('PASS', 'password009');

function validate($data)
{
    if (empty($data['url'])) {
        die('URL error!');
    }
    if (empty($data['cat'])) {
        die('Category error!');
    }
    if (empty($data['fname'])) {
        die('File Name error!');
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
    $cmd = "wget -c $url -O /tmp/$token >/tmp/$token.wget 2>&1";
    exec($cmd);
    return true;
}

function create_file($file, $bin_file, $token)
{
    #$token = sha1(random_bytes(12));
    $url = escapeshellarg(SERVER_URI.WEBDAV.$file);
    $cmd = "curl -# -u ".USER.":".PASS." -T $bin_file $url >/tmp/$token.curl 2>&1 && echo OK >/tmp/$token.ok";

    exec($cmd);
//    echo $cmd;
    return true;
}


function create_share($file, $pass)
{
    $url = SERVER_URI.API_PATH;
    $cmd = "curl -u ".USER.':'.PASS." $url/shares --data 'path=/$file&shareType=1&permissions=1&password=$pass'";
    $o = shell_exec($cmd);
    var_dump($o);

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


