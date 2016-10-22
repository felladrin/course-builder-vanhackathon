<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_chapter_content`.
 * Has foreign keys to the tables:
 *
 * - `course_chapter`
 * - `upload`
 */
class m161022_154611_create_course_chapter_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=latin1' : null;

        $this->createTable('course_chapter_content', [
            'id' => $this->primaryKey(),
            'couse_chapter_id' => $this->integer()->notNull(),
            'upload_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'url' => $this->string(),
            'order' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        // creates index for column `couse_chapter_id`
        $this->createIndex(
            'idx-course_chapter_content-couse_chapter_id',
            'course_chapter_content',
            'couse_chapter_id'
        );

        // add foreign key for table `course_chapter`
        $this->addForeignKey(
            'fk-course_chapter_content-couse_chapter_id',
            'course_chapter_content',
            'couse_chapter_id',
            'course_chapter',
            'id',
            'CASCADE'
        );

        // creates index for column `upload_id`
        $this->createIndex(
            'idx-course_chapter_content-upload_id',
            'course_chapter_content',
            'upload_id'
        );

        // add foreign key for table `upload`
        $this->addForeignKey(
            'fk-course_chapter_content-upload_id',
            'course_chapter_content',
            'upload_id',
            'upload',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `course_chapter`
        $this->dropForeignKey(
            'fk-course_chapter_content-couse_chapter_id',
            'course_chapter_content'
        );

        // drops index for column `couse_chapter_id`
        $this->dropIndex(
            'idx-course_chapter_content-couse_chapter_id',
            'course_chapter_content'
        );

        // drops foreign key for table `upload`
        $this->dropForeignKey(
            'fk-course_chapter_content-upload_id',
            'course_chapter_content'
        );

        // drops index for column `upload_id`
        $this->dropIndex(
            'idx-course_chapter_content-upload_id',
            'course_chapter_content'
        );

        $this->dropTable('course_chapter_content');
    }
}
