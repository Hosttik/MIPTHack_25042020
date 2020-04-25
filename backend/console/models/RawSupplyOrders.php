<?php
namespace console\models;

use console\classes\helpers\DatesSaveTrait;
use Yii;
use yii\db\ActiveRecord;

/**
 * Модель для таблицы Supply Orders
 *
 * @property integer $id
 * @property string $PlanId
 * @property string $ProductId
 * @property string $Order/Positions
 * @property string $ProductName
 * @property string $Vid_Product
 * @property integer $Count
 * @property string $IDSklad
 * @property string $Planned Status
 * @property string $Begin
 * @property string $End
 * @property string $Deadline
 * @property string $ProductIdFull
 * @property string $RoutingId
 * @property string $DownstreamCustomerOrders
 * @property integer $date_created
 * @property integer $date_modified
 */
class RawSupplyOrders extends ActiveRecord
{
    use DatesSaveTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raw_supply_orders';
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
            'ID план. зак.',
            'ProductId',
            'Заказ/Позиция',
            'Название продукта',
            'Vid_Product',
            'Кол-во',
            'ID склада',
            'Planned Status',
            'Начало',
            'Окончание',
            'Крайняя дата',
            'ProductIdFull',
            'RoutingId',
            'DownstreamCustomerOrders',
        ];
    }

    public static function getModelHeaders(): array
    {
        return [
            'PlanId',
            'ProductId',
            'Order/Positions',
            'ProductName',
            'Vid_Product',
            'Count',
            'IDSklad',
            'Planned Status',
            'Begin',
            'End',
            'Deadline',
            'ProductIdFull',
            'RoutingId',
            'DownstreamCustomerOrders',
        ];
    }

    public static function getReplaceHeaders(): array
    {
        return [
            'ID план. зак.' => 'PlanId',
            'Заказ/Позиция' => 'Order/Positions',
            'Название продукта' => 'ProductName',
            'Кол-во' => 'Count',
            'ID склада' => 'IDSklad',
            'Начало' => 'Begin',
            'Окончание' => 'End',
            'Крайняя дата' => 'Deadline',
        ];
    }

    public static function batchInsert($rows): void
    {
        $columns = self::getTableSchema()->columnNames;
        array_shift($columns);
        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
    }
}
