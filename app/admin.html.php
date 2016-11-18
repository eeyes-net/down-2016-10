<?php if (1 === count(get_included_files())) exit(); ?>
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
            padding-bottom: 3em;
        }
        h1 {
            padding: 1em 0;
            color: #fff;
            background: #246;
            text-align: center;
            font-family: 黑体, sans-serif;
        }
        h2 {
            margin-top: 1.5em;
            padding: .5em 0;
            color: #fff;
            background: #69c;
            text-align: center;
            font-family: 黑体, sans-serif;
        }
        li {
            padding: .7em 0;
            text-align: center;
            border-bottom: 1px solid #ccc;
            cursor: move;
        }
        p {
            margin-top: .5em;
            text-align: center;
        }
        table, ul {
            width: 100%;
            background: #eef;
        }
        th, td {
            padding: .3em;
            border: 1px solid #ccc;
        }
        select {
            width: 100%;
            height: 2em;
            font-size: 1em;
            box-sizing: border-box;
        }
        input {
            width: 100%;
            padding: 2px .3em;
            font-size: 1em;
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            width: 1em;
            height: 1em;
        }
        .submit-all {
            margin: 1.5em auto;
            padding: .5em 0;
            width: 60%;
            font-size: 1em;
        }
        .msg {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            padding: 1em 0;
            color: #fff;
            background: rgba(128, 255, 128, .5);
            text-align: center;
        }
        .msg-ok {
            background: rgba(128, 255, 128, .5);
        }
        .msg-error {
            background: rgba(255, 128, 128, .5);
        }
    </style>
</head>
<body>
    <h1>e快下管理页面</h1>
    <h2>已上架软件排序</h2>
    <form action="?type=list_sort" method="post" class="auto-submit">
        <ul id="items">
            <?php foreach ($list_enabled as &$item): ?>
                <li>
                    <input type="hidden" name="id[]" value="<?= htmlentities($item['id']) ?>"><?= htmlspecialchars($item['name']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>上下拖动排序，点击此处<input style="width: initial;" type="submit" value="提交"></p>
        <p>提交之后请执行<a href="index.php" target="_blank">预览并更新缓存</a></p>
    </form>
    <h2>所有软件信息</h2>
    <table>
        <thead>
            <tr>
                <th>序号</th>
                <th>软件名</th>
                <th>图标文件</th>
                <th>Win版文件</th>
                <th>Mac版文件</th>
                <th>软件描述</th>
                <th>是否上架</th>
                <th>提交</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as &$item): ?>
                <tr>
                    <form action="?type=list_update" method="post" class="auto-submit">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                        <td align="right"><?= htmlspecialchars($item['order']) ?></td>
                        <td><input type="text" name="name" value="<?= htmlentities($item['name']) ?>"></td>
                        <td><select type="text" name="icon_path">
                                <option value="">（无）</option>
                                <?php foreach ($icons as &$icon): ?>
                                    <option value="<?= htmlentities($icon) ?>"<?= ($icon == $item['icon_path']) ? ' selected' : '' ?>><?= htmlentities($icon) ?></option>
                                <?php endforeach; ?>
                            </select></td>
                        <td><select type="text" name="win_id">
                                <option value="0">（无）</option>
                                <?php foreach ($files as &$file): ?>
                                    <?php if ($file['enabled']): ?>
                                        <option value="<?= htmlentities($file['id']) ?>"<?= ($file['id'] == $item['win_id']) ? ' selected' : '' ?>><?= htmlspecialchars($file['path']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select></td>
                        <td><select type="text" name="mac_id">
                                <option value="0">（无）</option>
                                <?php foreach ($files as &$file): ?>
                                    <?php if ($file['enabled']): ?>
                                        <option value="<?= htmlentities($file['id']) ?>"<?= ($file['id'] == $item['mac_id']) ? ' selected' : '' ?>><?= htmlspecialchars($file['path']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select></td>
                        <td><input type="text" name="desc" value="<?= htmlentities($item['desc']) ?>"></td>
                        <td align="center">
                            <input type="checkbox" name="enabled" value="1"<?= $item['enabled'] ? ' checked' : '' ?>>
                        </td>
                        <td><input type="submit" value="提交"></td>
                    </form>
                </tr>
            <?php endforeach; ?>
            <tr>
                <form action="?type=list_new" method="post">
                    <td>new</td>
                    <td><input type="text" name="name"></td>
                    <td><select type="text" name="icon_path">
                            <option value="0">（无）</option>
                            <?php foreach ($icons as &$icon): ?>
                                <option value="<?= htmlentities($icon) ?>"<?= ($icon == $item['icon_path']) ? ' selected' : '' ?>><?= htmlspecialchars($icon) ?></option>
                            <?php endforeach; ?>
                        </select></td>
                    <td><select type="text" name="win_id">
                            <option value="0">（无）</option>
                            <?php foreach ($files as &$file): ?>
                                <?php if ($file['enabled']): ?>
                                    <option value="<?= htmlentities($file['id']) ?>"><?= htmlspecialchars($file['path']) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select></td>
                    <td><select type="text" name="mac_id">
                            <option value="0">（无）</option>
                            <?php foreach ($files as &$file): ?>
                                <?php if ($file['enabled']): ?>
                                    <option value="<?= htmlentities($file['id']) ?>"><?= htmlspecialchars($file['path']) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select></td>
                    <td><input type="text" name="desc"></td>
                    <td align="center"><input type="checkbox" name="enabled" value="1" checked></td>
                    <td><input type="submit" value="新建"></td>
                </form>
            </tr>
        </tbody>
    </table>
    <div>
        <p>
            <button class="submit-all">全部提交</button>
        </p>
        <p>提交之后请执行<a href="index.php" target="_blank">预览并更新缓存</a></p>
    </div>
    <h2>所有文件信息</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>文件路径</th>
                <th>文件大小</th>
                <th>文件版本</th>
                <th>是否可用</th>
                <th>提交</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as &$file): ?>
                <tr>
                    <form action="?type=file_update" method="post" class="auto-submit">
                        <input type="hidden" name="id" value="<?= htmlentities($file['id']) ?>">
                        <td align="right"><?= htmlspecialchars($file['id']) ?></td>
                        <td><?= htmlspecialchars($file['path']) ?></td>
                        <td align="right"><?= htmlspecialchars($file['size']) ?></td>
                        <td><input type="text" name="version" value="<?= htmlentities($file['version']) ?>"></td>
                        <td align="center">
                            <input type="checkbox" name="enabled" value="1"<?= $file['enabled'] ? ' checked' : '' ?>>
                        </td>
                        <td><input type="submit" value="提交"></td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <p>
            <button class="submit-all">全部提交</button>
        </p>
        <p>提交之后请执行<a href="index.php" target="_blank">预览并更新缓存</a></p>
        <p><a href="logout.php">退出登录</a></p>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/Sortable.min.js"></script>
    <script>
        Sortable.create(document.getElementById('items'), {animation: 150});
        $('form').submit(function (e) {
            e.preventDefault();
            $.post($(this).attr('action'), $(this).serialize(), function (text) {
                var is_ok = (text == 'ok');
                var msg_text = is_ok ? '提交成功' : '提交失败';
                var msg_class = is_ok ? 'msg-ok' : 'msg-error';
                $('body').append($('<div class="msg"></div>')
                    .text(msg_text)
                    .addClass(msg_class)
                    .fadeOut(2000, function () {
                        $(this).remove();
                    }));
            });
        });
        $('.submit-all').click(function () {
            $('.auto-submit').submit();
        });
    </script>
</body>
</html>