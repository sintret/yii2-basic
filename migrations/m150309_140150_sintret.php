<?php

use yii\db\Schema;
use yii\db\Migration;

class m150309_140150_sintret extends Migration {

    public function safeUp() {

        $this->createTable('chat', [
            'id' => 'pk',
            'userId' => Schema::TYPE_INTEGER,
            'message' => Schema::TYPE_TEXT,
            'updateDate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ]);

        $this->createTable('log_upload', [
            'id' => 'pk',
            'userId' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'filename' => Schema::TYPE_STRING,
            'fileori' => Schema::TYPE_STRING,
            'params' => Schema::TYPE_TEXT,
            'values' => Schema::TYPE_TEXT,
            'warning' => Schema::TYPE_TEXT,
            'keys' => Schema::TYPE_TEXT,
            'type' => Schema::TYPE_SMALLINT,
            'userCreate' => Schema::TYPE_INTEGER,
            'userUpdate' => Schema::TYPE_INTEGER,
            'updateDate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'createDate' => Schema::TYPE_DATETIME . ' NULL',
        ]);

        $this->createTable('notification', [
            'id' => 'pk',
            'userId' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'message' => Schema::TYPE_TEXT,
            'url' => Schema::TYPE_STRING,
            'params' => Schema::TYPE_TEXT,
            'userCreate' => Schema::TYPE_INTEGER,
            'userUpdate' => Schema::TYPE_INTEGER,
            'updateDate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'createDate' => Schema::TYPE_DATETIME . ' NULL',
        ]);

        $this->createTable('tbl_dynagrid', [
            'id' => Schema::TYPE_STRING . ' NOT NULL',
            'filter_id' => Schema::TYPE_STRING . ' NULL',
            'sort_id' => Schema::TYPE_STRING . ' NULL',
            'data' => Schema::TYPE_TEXT . ' NOT NULL',
        ]);

        $this->createTable('tbl_dynagrid_dtl', [
            'id' => Schema::TYPE_STRING . ' NOT NULL',
            'category' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'data' => Schema::TYPE_TEXT . ' NOT NULL',
            'dynagrid_id' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('todolist', [
            'id' => 'pk',
            'userId' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_SMALLINT,
            'params' => Schema::TYPE_TEXT,
            'createDate' => Schema::TYPE_DATETIME . ' NULL',
            'updateDate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ]);

        $this->createTable('setting', [
            'id' => 'pk',
            'emailAdmin' => Schema::TYPE_STRING,
            'emailSupport' => Schema::TYPE_STRING,
            'emailOrder' => Schema::TYPE_STRING,
            'sendgridUsername' => Schema::TYPE_STRING,
            'sendgridPassword' => Schema::TYPE_STRING,
            'whatsappNumber' => Schema::TYPE_STRING,
            'whatsappPassword' => Schema::TYPE_STRING,
            'whatsappSend' => Schema::TYPE_STRING,
            'facebook' => Schema::TYPE_STRING,
            'instagram' => Schema::TYPE_STRING,
            'google' => Schema::TYPE_STRING,
            'twitter' => Schema::TYPE_STRING,
            'privacyPolicy' => Schema::TYPE_TEXT,
            'terms' => Schema::TYPE_TEXT,
            'legalNotice' => Schema::TYPE_TEXT,
            'userCreate' => Schema::TYPE_INTEGER,
            'userUpdate' => Schema::TYPE_INTEGER,
            'createDate' => Schema::TYPE_DATETIME . ' NULL',
            'updateDate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ]);

        $this->createTable('user', [
            'id' => 'pk',
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING,
            'password_hash' => Schema::TYPE_STRING,
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'name' => Schema::TYPE_STRING . ' NULL',
            'avatar' => Schema::TYPE_STRING . ' NULL',
            'phone' => Schema::TYPE_STRING . ' NULL',
            'city' => Schema::TYPE_STRING,
            'role' => Schema::TYPE_SMALLINT,
            'status' => Schema::TYPE_SMALLINT,
            'banner_top' => Schema::TYPE_STRING . ' NULL',
            'position' => Schema::TYPE_STRING . ' NULL',
            'hobby' => Schema::TYPE_SMALLINT,
            'params' => Schema::TYPE_TEXT,
            'description' => Schema::TYPE_TEXT,
            'createDate' => Schema::TYPE_DATETIME . ' NULL',
            'updateDate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ]);
    }

    public function safeDown() {
        $this->dropTable('chat');
        $this->dropTable('log_upload');
        $this->dropTable('notification');
        $this->dropTable('tbl_dynagrid');
        $this->dropTable('tbl_dynagrid_dtl');
        $this->dropTable('todolist');
        $this->dropTable('setting');
        $this->dropTable('user');
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
