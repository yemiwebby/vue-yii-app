<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $author
 * @property string|null $iban
 * @property int|null $release_year
 * @property string|null $cover_image
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['release_year'], 'integer'],
            [['title', 'author', 'iban', 'cover_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'iban' => 'Iban',
            'release_year' => 'Release Year',
            'cover_image' => 'Cover Image',
        ];
    }
}
