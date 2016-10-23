<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_chapter`.
 * Has foreign keys to the tables:
 *
 * - `course`
 */
class m161022_153539_create_course_chapter_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=latin1' : null;

        $this->createTable('course_chapter', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'order' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        // creates index for column `course_id`
        $this->createIndex(
            'idx-course_chapter-course_id',
            'course_chapter',
            'course_id'
        );

        // add foreign key for table `course`
        $this->addForeignKey(
            'fk-course_chapter-course_id',
            'course_chapter',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `course`
        $this->dropForeignKey(
            'fk-course_chapter-course_id',
            'course_chapter'
        );

        // drops index for column `course_id`
        $this->dropIndex(
            'idx-course_chapter-course_id',
            'course_chapter'
        );

        $this->dropTable('course_chapter');
    }
}
