<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m211006_115328_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title'        => $this->string(),
            'author'       => $this->string(),
            'iban'         => $this->string(),
            'release_year' => $this->smallInteger(),
            'cover_image'  => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
