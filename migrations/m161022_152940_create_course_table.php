<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m161022_152940_create_course_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=latin1' : null;

        $this->createTable('course', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'subtitle' => $this->string(),
            'description' => $this->text(),
            'price' => $this->decimal(8,2),
            'duration' => $this->decimal(5,1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-course-user_id',
            'course',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-course-user_id',
            'course',
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
            'fk-course-user_id',
            'course'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-course-user_id',
            'course'
        );

        $this->dropTable('course');
    }
}
