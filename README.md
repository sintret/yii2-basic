# yii2-basic
Super fast create application using Yii2 Basic Template with feature like adminlte, chat, whatapp messaging, ckeditor, todolist, whatsapp, graphic, signup form, easy rbac manager using dbmanager and many many feature

Plese read other tutorial at <a href="http://sintret.com/blog_detail/523/yii2_create_project_with_adminlte_basic_and_advanced_easyly">http://sintret.com/blog_detail/523/yii2_create_project_with_adminlte_basic_and_advanced_easyly</a>

BASIC TEMPLATE

Go to your project directory, case in my linux debian as  cd /usr/share/nginx/html/project

we will using composer to download and install application template with adminlte.

lets get with your console:

composer create-project sintret/yii2-basic your-folder-directory-name

you just get coffe and waiting until download and instalation process done. ok, and then go to your project directory and execute init with "php init".

edit your config db.php and change your dbname

dsn' => 'mysql:host=localhost;dbname=yii2basic',

dont forget to create database with the same configuration as dbname.

 

we need migrate to create table chat, user, todolist,log upload,dynagrid, notification.

After its done, you need migration like these following "./yii migrate" in linux, or in windows "yii migrate".

 

ok, we need again to user

just using like these following code :

"yii insert/init"

 

finaly we create rbac dbmanager with simple code, you can see in folder "console/RbacController" with specific level for :

    Admin : can do everything
    Editor : can edit, add and view
    Author : can add and view
    viewer ; just viewer

 create rbac :

"yii migrate --migrationPath=@yii/rbac/migrations"

"yii rbac/init"