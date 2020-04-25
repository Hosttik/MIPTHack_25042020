<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы COLS
 *
 * @property integer $id
 * @property string $COLAlloc
 * @property string $Quantity
 * @property string $MinQuantity
 * @property string $MaxQuantity
 * @property string $HasSalesBudgetReservation
 * @property string $RequiresOrderCombination
 * @property string $NrOfActiveRoutingChainUpstream
 * @property string $SelectedShippingShop
 * @property string $ViewGP
 * @property string $DeliveryType
 * @property string $ImgPlannedStatus
 * @property string $RoutingId
 * @property string $Name
 * @property string $ProductId
 * @property string $ProductName',
 * @property string $LatestDesiredDeliveryDate
 * @property string $ProductSpecificationId
 * @property string $ResourceGroupIds
 * @property integer $date_created
 * @property integer $date_modified
 */
class RawCols extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_cols';
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
            'COLAlloc',
            'Quantity',
            'MinQuantity',
            'MaxQuantity',
            'HasSalesBudgetReservation',
            'RequiresOrderCombination',
            'NrOfActiveRoutingChainUpstream',
            'SelectedShippingShop',
            'Вид ГП',
            'DeliveryType',
            'ImgPlannedStatus',
            'RoutingId',
            'Name',
            'ProductId',
            'ProductName',
            'LatestDesiredDeliveryDate',
            'ProductSpecificationId',
            'ResourceGroupIds',
        ];
    }

    public static function getModelHeaders(): array
    {
        return [
            'COLAlloc',
            'Quantity',
            'MinQuantity',
            'MaxQuantity',
            'HasSalesBudgetReservation',
            'RequiresOrderCombination',
            'NrOfActiveRoutingChainUpstream',
            'SelectedShippingShop',
            'ViewGP',
            'DeliveryType',
            'ImgPlannedStatus',
            'RoutingId',
            'Name',
            'ProductId',
            'ProductName',
            'LatestDesiredDeliveryDate',
            'ProductSpecificationId',
            'ResourceGroupIds',
        ];
    }

    public static function getReplaceHeaders(): array
    {
        return ['Вид ГП' => 'ViewGP'];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
