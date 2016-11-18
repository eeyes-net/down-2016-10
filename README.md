# e快下

<http://down.eeyes.net>

* 2016年10月15日内部测试
* 2016年10月16日v0.1版正式上线
* 2016年10月17日v1.0版上线，当天v1.1版上线
* 2016年10月26日v2.0版上线
* 2016年11月18日v3.0版完成

## 安装

1. 要求：`php >= 5.4`，打开`MySQLi`扩展

2. 将代码解压到服务器的目录下

3. 将`config.sample.php`改为`config.php`，并配置数据库信息、管理员密码、服务器目录、主页缓存文件

4. 根据需求修改`install.sample.sql`并在MySQL中执行，生成数据库

5. 访问`http://localhost/app/admin.php`登录管理界面，手动添加和修改软件信息

6. 访问`http://localhost/app/index.php`生成主页缓存文件

7. 此时访问主页即可

## 说明

* 最好将应用目录和资源目录分开放置

## Author

* Ganlv
* ensorrow

## LICENSE

[Apache 2.0](http://www.apache.org/licenses/LICENSE-2.0)