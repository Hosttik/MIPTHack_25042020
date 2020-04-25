<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы ResourceGroupPeriod
 *
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property string $description
 * @property integer $date_created
 * @property integer $date_modified
 */
class Shop extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created', 'date_modified'], 'integer'],
        ];
    }

    public static function getExcelHeaders(): array
    {
        return [
            'Код цеха',
            'Цех',
            'Описание',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'code',
            'title',
            'description',
        ];
    }


    public static function getReplaceHeaders(): array
    {
        return [
            'Код цеха' => 'code',
            'Цех' => 'title',
            'Описание' => 'description',
        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
