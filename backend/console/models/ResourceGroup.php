<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы ResourceGroupPeriod
 *
 * @property integer $id
 * @property string $ResourceGroupId
 * @property string $NameRG
 * @property string $RG_Id
 * @property string $NameSR
 * @property string $LongName
 * @property integer $date_created
 * @property integer $date_modified
 */
class ResourceGroup extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource_group';
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
            'ResourceGroupId',
            'Name RG',
            'Id',
            'Name SR',
            'LongName',
        ];
    }


    public static function getModelHeaders(): array
    {
        return [
            'ResourceGroupId',
            'NameRG',
            'RG_Id',
            'NameSR',
            'LongName',
        ];
    }


    public static function getReplaceHeaders(): array
    {
        return [
            'Name RG' => 'NameRG',
            'Id' => 'RG_Id',
            'Name SR' => 'NameSR',
        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
