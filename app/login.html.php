<?php //if (1 === count(get_included_files())) exit(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>e快下管理页面</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background: #eef;
        }
        h1 {
            padding: 1em 0;
            color: #fff;
            background: #246;
            text-align: center;
            font-family: 黑体, sans-serif;
        }
        form {
            margin-top: 3em;
        }
        p {
            margin: 1em auto;
            font-size: 1.2em;
            width: 20em;
            max-width: 80%;
        }
        input {
            padding: .3em;
            width: 100%;
            font-size: 1.3em;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            color: #fff;
            background-color: #69c;
        }
    </style>
</head>
<body>
    <h1>e快下管理登录</h1>
    <form method="post">
        <p><input type="password" name="password" autofocus placeholder="请输入登录密码..."></p>
        <p><input type="submit"></p>
    </form>
</body>
</html>
