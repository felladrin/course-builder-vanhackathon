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
            'couse_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'order' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        // creates index for column `couse_id`
        $this->createIndex(
            'idx-course_chapter-couse_id',
            'course_chapter',
            'couse_id'
        );

        // add foreign key for table `course`
        $this->addForeignKey(
            'fk-course_chapter-couse_id',
            'course_chapter',
            'couse_id',
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
            'fk-course_chapter-couse_id',
            'course_chapter'
        );

        // drops index for column `couse_id`
        $this->dropIndex(
            'idx-course_chapter-couse_id',
            'course_chapter'
        );

        $this->dropTable('course_chapter');
    }
}
