<?php if (1 === count(get_included_files())) exit(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>e快下</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            list-style: none;
            font-family: "PingFang SC", "Hiragino Sans GB", "STHeiti", "Microsoft YaHei", sans-serif;
        }
        p {
            color: #525e66;
        }
        .f-cl::after {
            content: '';
            display: block;
            clear: both;
        }
        .header {
            background-color: #1f3c5a;
            height: 64px;
            min-width: 1270px;
        }
        .logo-left {
            float: left;
            margin-top: 15px;
        }
        .logo-right {
            float: right;
            margin-top: 20px;
        }
        .tip {
            height: 80px;
            background-color: #fafafa;
            min-width: 1270px;
        }
        .icon-tip {
            display: inline-block;
            float: left;
            width: 36px;
            height: 36px;
            background: url(img/notice.png) no-repeat;
            margin-right: 8px;
            margin-top: 22px;
        }
        .tip p {
            line-height: 80px;
            font-size: 14px;
        }
        .content {
            background-color: #e8ecef;
        }
        .content li {
            width: 623px;
            background: #fafafa;
            float: left;
            margin: 32px 0 0 0;
        }
        .content ul {
            background-color: #e8ecef;
        }
        .cn-body {
            padding: 28px 32px 0 32px;
        }
        .name {
            border-bottom: 1px solid #dcdfe0;
            height: 64px;
            line-height: 64px;
            padding-bottom: 28px;
        }
        .cn-body h1 {
            float: left;
            display: inline-block;
            margin: 0 14px;
            font-size: 24px;
            font-weight: bold;
            height: 64px;
            line-height: 64px;
            color: #38414b;
        }
        .cn-body p {
            margin-top: 24px;
            font-size: 14px;
            line-height: 24px;
            height: 96px;
            overflow: auto;
        }
        .cn-footer {
            height: 85px;
            padding: 0 32px;
        }
        .shadow {
            box-shadow: 0 1px 2px #c8cacc;
            position: relative;
        }
        .shadow::after {
            content: '';
            display: block;
            box-shadow: 0 2px 4px #dcdfe0;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
        }
        .cn-footer p {
            font-size: 14px;
            line-height: 24px;
            margin-top: 34px;
            margin-right: 8px;
            float: left;
        }
        .cn-footer a {
            height: 40px;
            text-align: center;
            line-height: 48px;
            display: inline-block;
            float: right;
            padding: 0 8px;
            margin-top: 25px;
            margin-left: 10px;
            border: 1px solid #dcdfe0;
            font-weight: bold;
            background-color: #f2f5f7;
            color: #000;
            text-decoration: none;
            transition: .2s ease-in all;
        }
        .cn-footer a p {
            font-size: 12px;
            font-weight: 300;
        }
        .cn-footer a:hover {
            background-color: #e9eef2;
            border: 1px solid #b8c4cc;
        }
        .footer {
            background-color: #e8ecef;
            text-align: center;
            padding-top: 72px;
            min-width: 1270px;
        }
        .footer p {
            width: 394px;
            font-size: 14px;
            line-height: 64px;
            margin: 0 auto 72px;
            background-color: #fff;
        }
        .footer img {
            margin-bottom: 64px;
        }
        .inner {
            width: 1270px;
            margin: 0 auto;
            height: 100%;
        }
        @media screen and (max-width: 1919px) {
            .content li:nth-child(even) {
                margin-left: 24px;
            }
        }
        @media screen and (min-width: 1920px) {
            .inner {
                width: 1824px;
            }
            .header, .content, .footer {
                min-width: 1824px;
            }
            .content li {
                margin-left: 24px;
                width: 592px;
            }
            .content li:nth-child(3n+1) {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="inner f-cl">
            <img src="img/logo.png" class="logo-left">
            <img src="img/logo_right.png" class="logo-right">
        </div>
    </div>
    <div class="tip shadow">
        <div class="inner f-cl">
            <i class="icon-tip"></i>
            <p style="float:left">
                提示：校园网下载，不消耗校园网流量 (无需登录校园网即可访问)
            </p>
        </div>
    </div>
    <div class="content">
        <ul class="inner f-cl" id="inner">
            <?php foreach ($list_enabled as &$item): ?>
                <li class="shadow">
                    <div class="cn-body">
                        <div class="name">
                            <img style="display:inline-block;float:left;" src="<?= htmlentities($item['icon_path']) ?>" height="64px" width="64px"/>
                            <h1><?= htmlspecialchars($item['name']) ?></h1></div>
                        <p><?= htmlspecialchars($item['desc']) ?></p>
                    </div>
                    <div class="cn-footer f-cl">
                        <p><?= isset($item['win']) ? ' Win: ' . htmlspecialchars($item['win']['version']) : '' ?><?= isset($item['mac']) ? ' Mac: ' . htmlspecialchars($item['mac']['version']) : '' ?></p>
                        <?php if (isset($item['win'])): ?>
                            <a href="http://down.eeyes.net/<?= htmlentities($item['win']['path']) ?>" title="<?= htmlentities($item['win']['size']) ?>"><img src="img/win.png"/>
                                <p style="margin:8px 4px 0 8px;float:right;">WIN版本</p></a>
                        <?php endif; ?>
                        <?php if (isset($item['mac'])): ?>
                            <a href="http://down.eeyes.net/<?= htmlentities($item['mac']['path']) ?>" title="<?= htmlentities($item['mac']['size']) ?>"><img src="img/mac.png"/>
                                <p style="margin:8px 4px 0 8px;float:right;">MAC版本</p></a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="footer">
        <div class="inner">
            <p class="shadow">其他常用软件正在上传中，敬请期待..</p>
            <img src="img/footer.png">
        </div>
    </div>
</body>
</html>
