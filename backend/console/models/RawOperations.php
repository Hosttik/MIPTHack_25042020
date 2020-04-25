<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы Operations
 *
 * @property integer $id
 * @property string $IdOperation
 * @property string $OperationDescription
 * @property integer $SequenceNr
 * @property string $AvailabledResN
 * @property string $Start
 * @property string $End
 * @property string $ProductionTime
 * @property float $InputQuantity
 * @property float $Output quantity
 * @property string $SchedulingSpace
 * @property string $ResourceGroupId
 * @property integer $OperationCode
 * @property string $RoutingStepId
 * @property integer $date_created
 * @property integer $date_modified
 */
class RawOperations extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_operations';
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
            'Id',
            'OperationDescription',
            'SequenceNr',
            'Разрешенные стд. рес. №',
            'Start',
            'End',
            'ProductionTime',
            'InputQuantity',
            'Output quantity',
            'SchedulingSpace',
            'ResourceGroupId',
            'OperationCode',
            'RoutingStepId',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'IdOperation',
            'OperationDescription',
            'SequenceNr',
            'AvailabledResN',
            'Start',
            'End',
            'ProductionTime',
            'InputQuantity',
            'Output quantity',
            'SchedulingSpace',
            'ResourceGroupId',
            'OperationCode',
            'RoutingStepId',
        ];
    }


    public static function getReplaceHeaders(): array
    {
        return [
            'Id' => 'IdOperation',
            'Разрешенные стд. рес. №' => 'AvailabledResN',
        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
