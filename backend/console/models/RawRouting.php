<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы ResourceGroupPeriod
 *
 * @property integer $id
 * @property string $RoutingId
 * @property string $InputProductId
 * @property string $OutputProductId
 * @property string $InputStockingPointId
 * @property string $OutputStockingPointId
 * @property integer $date_created
 * @property integer $date_modified
 */
class RawRouting extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_routing';
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
            'RoutingId',
            'InputProductId',
            'OutputProductId',
            'InputStockingPointId',
            'OutputStockingPointId',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'RoutingId',
            'InputProductId',
            'OutputProductId',
            'InputStockingPointId',
            'OutputStockingPointId',
        ];
    }


    public static function getReplaceHeaders(): array
    {
        return [

        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
