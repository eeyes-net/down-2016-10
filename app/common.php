<?php
/**
 * 获取配置项
 *
 * @param $key
 *
 * @return mixed
 */
function config($key)
{
    static $config = null;
    if (is_null($config)) {
        $config = include 'config.php';
    }
    return $config[$key];
}

/**
 * 连接数据库
 *
 * @return mysqli
 */
function connect_db()
{
    $database = config('database');
    $mysqli = new mysqli($database['hostname'], $database['username'], $database['password'], $database['database']);
    $mysqli->set_charset('utf-8');
    return $mysqli;
}

/**
 * 检查是否登录，未登录则跳转到登录页面
 */
function check_login()
{
    if (empty($_SESSION['admin'])) {
        header('Location: login.php');
        exit();
    }
}

/**
 * 遍历指定目录即子目录的文件
 *
 * @param $path string 开始遍历的目录
 * @param $root string 服务器根目录
 *
 * @return array 包含所有文件（不含文件夹）的文件名、路径、绝对路径、相对根目录的路径、文件大小的数组
 */
function &scan_file($path, $root)
{
    // 遍历指定目录并除去.和..
    $files = array_diff(scandir($path), array('..', '.'));
    $ret_arr = [];
    foreach ($files as &$file) {
        $file_path = $path . '/' . $file;
        if (is_dir($file_path)) {
            $ret_arr += scan_file($file_path, $root);
        } else {
            // 获取绝对路径
            $abs_path = realpath($file_path);
            // 判断是否以指定根目录开始
            if (strpos($abs_path, $root) === 0) {
                $ret_arr[] = [
                    'name' => $file,
                    'path' => $file_path,
                    'abs_path' => $abs_path,
                    'rel_path' => substr($abs_path, strlen($root) + 1), // 除去首部的根目录，转换为相对路径
                    'size' => filesize($abs_path),
                ];
            }
        }
    }
    return $ret_arr;
}

/**
 * 方便人类阅读的文件大小表示法
 *
 * @param $bytes int 字节数
 *
 * @return string
 */
function readable_size($bytes)
{
    if ($bytes < 1024) {
        return $bytes . 'B';
    }
    if ($bytes < 1048576) {
        return round($bytes / 1024, 1) . 'K';
    }
    if ($bytes < 1073741824) {
        return round($bytes / 1048576, 1) . 'M';
    }
    return round($bytes / 1073741824, 1) . 'G';
}

/**
 * HTML去除多余空格
 *
 * @param $html string HTML
 *
 * @return string
 */
function compress_html($html)
{
    return str_replace('> <', '><', trim(preg_replace('/\\s+/s', ' ', preg_replace('/<!--.*?-->/s', '', $html))));
}