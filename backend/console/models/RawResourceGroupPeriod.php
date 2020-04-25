<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы ResourceGroupPeriod
 *
 * @property integer $id
 * @property string $ResourceGroupID
 * @property string $Id
 * @property string $AvailableCapacity
 * @property string $FreeCapacity
 * @property string $Start
 * @property string $HasFiniteCapacity
 * @property integer $date_created
 * @property integer $date_modified
 */
class RawResourceGroupPeriod extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_resource_group_period';
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
            'ResourceGroupID',
            'Id',
            'AvailableCapacity',
            'FreeCapacity',
            'Start',
            'HasFiniteCapacity',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'ResourceGroupID',
            'IdPeriod',
            'AvailableCapacity',
            'FreeCapacity',
            'Start',
            'HasFiniteCapacity',
        ];
    }


    public static function getReplaceHeaders(): array
    {
        return [
            'Id' => 'IdPeriod',
        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
