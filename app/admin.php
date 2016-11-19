<?php
// 加载公共文件
require 'common.php';
// 开启回话
session_start();
// 检查是否登录
check_login();
// 连接数据库
$mysqli = connect_db();

// 如果POST了更新的条目
if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'list_sort':
            // 上架软件排序
            $stmt = $mysqli->prepare('UPDATE `down_list` SET `order` = ? WHERE `id` = ?');
            $stmt->bind_param('dd', $order, $id);
            foreach ($_POST['id'] as $order => $id) {
                $stmt->execute();
            }
            $stmt->close();
            break;
        case 'list_update':
            // 更新软件信息
            $enabled = !empty($_POST['enabled']);
            $stmt = $mysqli->prepare('UPDATE `down_list` SET `name` = ?, `icon_path` = ?, `win_id` = ?, `mac_id` = ?, `desc` = ?, `enabled` = ? WHERE `id` = ?');
            $stmt->bind_param('ssddsdd', $_POST['name'], $_POST['icon_path'], $_POST['win_id'], $_POST['mac_id'], $_POST['desc'], $enabled, $_POST['id']);
            $stmt->execute();
            $stmt->close();
            break;
        case 'list_new':
            // 新增软件
            $enabled = !empty($_POST['enabled']);
            $stmt = $mysqli->prepare('INSERT INTO `down_list` (`name`, `icon_path`, `win_id`, `mac_id`, `desc`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('ssddsd', $_POST['name'], $_POST['icon_path'], $_POST['win_id'], $_POST['mac_id'], $_POST['desc'], $enabled);
            $stmt->execute();
            $stmt->close();
            break;
        case 'file_update':
            // 更新文件信息
            $enabled = !empty($_POST['enabled']);
            $stmt = $mysqli->prepare('UPDATE `down_file` SET `version` = ?, `enabled` = ? WHERE `id` = ?');
            $stmt->bind_param('sdd', $_POST['version'], $enabled, $_POST['id']);
            $stmt->execute();
            $stmt->close();
            break;
        default:
            exit();
    }
    exit('ok');
}

// 读取所有文件信息
$result = $mysqli->query('SELECT `id`, `path`, `size`, `version`, `enabled` FROM `down_file`');
$files = $result->fetch_all(MYSQLI_ASSOC);
$result->close();
// 如果文件不存在则删除
$stmt = $mysqli->prepare('DELETE FROM `down_file` WHERE `id` = ?');
$stmt->bind_param('d', $file['id']);
foreach ($files as &$file) {
    $file['exist'] = file_exists(config('directory')['root'] . '/' . $file['path']);
    if (!$file['exist']) {
        $stmt->execute();
    }
}
$stmt->close();

// 遍历下载目录
$files = scan_file(config('directory')['down'], config('directory')['root']);
// 插入数据库（`path_ md5`是UNIQUE索引，会自动排除已存在的文件）
$stmt = $mysqli->prepare('INSERT INTO `down_file` (`name_md5`, `path`, `size`) VALUES (?, ?, ?)');
$stmt->bind_param('ssd', $name_md5, $path, $size);
foreach ($files as &$file) {
    $name_md5 = md5($file['name']);
    $path = $file['rel_path'];
    $size = $file['size'];
    $stmt->execute();
}
$stmt->close();
// 遍历图标目录
$icons = scan_file(config('directory')['icon'], config('directory')['root']);
$tmp = [];
foreach ($icons as &$icon) {
    $tmp[] = $icon['rel_path'];
}
$icons = &$tmp;

// 按顺序读取所有已上架软件
$result = $mysqli->query('SELECT `id`, `name` FROM `down_list` WHERE `enabled` = 1 ORDER BY `order` ASC');
$list_enabled = $result->fetch_all(MYSQLI_ASSOC);
$result->close();
// 读取所有软件信息
$result = $mysqli->query('SELECT `id`, `name`, `icon_path`, `win_id`, `mac_id`, `desc`, `order`, `enabled` FROM `down_list` ORDER BY `enabled` DESC, `order` ASC');
$list = $result->fetch_all(MYSQLI_ASSOC);
$result->close();
// 读取所有文件信息
$result = $mysqli->query('SELECT `id`, `path`, `size`, `version`, `enabled` FROM `down_file` ORDER BY `path` ASC');
$files = $result->fetch_all(MYSQLI_ASSOC);
$result->close();
foreach ($files as &$file) {
    $file['size'] = readable_size($file['size']);
}

// 关闭数据库
$mysqli->close();
// 渲染管理界面
ob_start();
include dirname(__FILE__) . '/admin.html.php';
echo compress_html(ob_get_clean());
