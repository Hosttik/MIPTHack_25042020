<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы ResourceGroupPeriod
 *
 * @property integer $id
 * @property string RoutingStepId
 * @property integer SequenceNr
 * @property string RoutingId
 * @property string ResourceGroupId
 * @property float Yield
 * @property integer IdPlant
 * @property integer $date_created
 * @property integer $date_modified
 */
class RawRoutingSteps extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_routing_steps';
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
            'RoutingStepId',
            'SequenceNr',
            'RoutingId',
            'ResourceGroupId',
            'Yield',
            'IdPlant',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'RoutingStepId',
            'SequenceNr',
            'RoutingId',
            'ResourceGroupId',
            'Yield',
            'IdPlant',
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
