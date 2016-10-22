<?php

use yii\db\Migration;

/**
 * Handles the creation of table `upload`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m161022_151834_create_upload_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=latin1' : null;

        $this->createTable('upload', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'uniqid' => $this->string()->notNull()->unique(),
            'extension' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-upload-user_id',
            'upload',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-upload-user_id',
            'upload',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-upload-user_id',
            'upload'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-upload-user_id',
            'upload'
        );

        $this->dropTable('upload');
    }
}
