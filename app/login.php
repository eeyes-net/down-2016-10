<?php
// 加载配置文件
$config = include 'config.php';
// 开启回话
session_start();
// 如果POST了密码
if (isset($_POST['password'])) {
    // 判断密码是否正确
    if ($_POST['password'] === $config['admin']['password']) {
        // 设置登录标记
        $_SESSION['admin'] = true;
        // 重定向到管理页面
        header('Location: admin.php');
        exit('登录成功');
    } else {
        // 后退回登录页面
        header("location:javascript://history.go(-1)");
    }
} else {
    // 输出登录页面
    exit('<form method="post"><input type="password" name="password"><input type="submit"></form>');
}