<?php
/**
 *  @author Jakhar <https://github.com/jakharbek>
 *  @author Nazrullo <https://github.com/nazrullo>
 *  @author O`tkir    <https://github.com/utkir24>
 *  @team Adigitalteam <https://github.com/adigitalteam>
 *  @package Cart of shop
 */
namespace common\modules\testimonials\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `testimonials`.
 */
class m180715_115427_create_table_testimonials_table extends Migration
{
    public $tableName = '{{%testimonials}}';
    public $userTableName = '{{%user}}';
    public $deleteType = 'CASCADE';
    public $user_column = 'id';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'text' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
        ], $tableOptions);
        $this->createIndex('{{%idx-testimonials-user_id}}', $this->tableName, 'user_id');
        $this->createIndex('{{%idx-testimonials-parent_id}}', $this->tableName, 'parent_id');
        $this->addForeignKey('{{%fk-testimonials-user_id}}', $this->tableName, 'user_id', $this->userTableName, $this->user_column, $this->deleteType);
        $this->addForeignKey('{{%fk-testimonials-parent_id}}', $this->tableName, 'parent_id', $this->tableName, 'id', $this->deleteType);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
