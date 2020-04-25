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
 * @property string $description
 * @property integer $date_created
 * @property integer $date_modified
 */
class Warhouse extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warhouse';
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
            'Код склада',
            'Склад',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'code',
            'description',
        ];
    }


    public static function getReplaceHeaders(): array
    {
        return [
            'Код склада' => 'code',
            'Склад' => 'description',
        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
