<?php
// 加载公共文件
require 'common.php';
// 开启回话
session_start();
// 连接数据库
$mysqli = connect_db();

// 按顺序读取所有已上架软件
$result = $mysqli->query('SELECT `name`, `icon_path`, `win_id`, `mac_id`, `desc` FROM `down_list` WHERE `enabled` = 1 ORDER BY `order` ASC');
$list_enabled = $result->fetch_all(MYSQLI_ASSOC);
$result->close();
// 读取所有文件信息
$result = $mysqli->query('SELECT `id`, `path`, `size`, `version`, `enabled` FROM `down_file` WHERE `enabled` = 1');
$files = $result->fetch_all(MYSQLI_ASSOC);
$result->close();

// 关闭数据库
$mysqli->close();

// 数据处理
// 转化为以id值作为数组索引
$tmp = [];
foreach ($files as &$file) {
    $file['size'] = readable_size($file['size']);
    $tmp[$file['id']] = &$file;
}
$files = &$tmp;
//
foreach ($list_enabled as &$item) {
    if (isset($files[$item['win_id']])) {
        $item['win'] = &$files[$item['win_id']];
    }
    if (isset($files[$item['mac_id']])) {
        $item['mac'] = &$files[$item['mac_id']];
    }
}
// 渲染界面
ob_start();
include dirname(__FILE__) . '/index.html.php';
$html = compress_html(ob_get_clean());
// 写入缓存
file_put_contents(config('cache'), $html);
echo $html;
