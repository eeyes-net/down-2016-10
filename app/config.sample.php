<?php
return [
    'database' => [
        'hostname' => '127.0.0.1',
        'username' => 'test',
        'password' => 'test',
        'database' => 'test_down',
    ],
    'admin' => [
        'password' => 'test',
    ],
    'directory' => [
        'root' => realpath('../public'), // 服务器根目录
        'down' => '../public/down', // 软件文件夹
        'icon' => '../public/icon', // 图标文件夹
    ],
    'cache' => '../public/index.html', // 主页缓存
];