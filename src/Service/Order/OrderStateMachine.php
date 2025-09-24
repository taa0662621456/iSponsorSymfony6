<?php
namespace App\Service\Order;

use App\Entity\Order\OrderStorage;
use App\Enum\OrderStatusEnum;
use DomainException;

class OrderStateMachine
{
    private array $transitions = [
        OrderStatusEnum::NEW->value => [
            'pay'    => OrderStatusEnum::PAID->value,
            'cancel' => OrderStatusEnum::CANCELLED->value,
        ],
        OrderStatusEnum::PAID->value => [
            'ship'   => OrderStatusEnum::SHIPPED->value,
            'cancel' => OrderStatusEnum::CANCELLED->value,
            'refund' => OrderStatusEnum::REFUNDED->value,
        ],
        OrderStatusEnum::SHIPPED->value => [
            'complete' => OrderStatusEnum::COMPLETED->value,
            'refund'   => OrderStatusEnum::REFUNDED->value,
        ],
        OrderStatusEnum::COMPLETED->value => [
            'refund' => OrderStatusEnum::REFUNDED->value,
        ],
    ];

    /**
     * Проверка, можно ли выполнить действие для заказа.
     *
     * @param OrderStorage $order
     * @param string $action
     * @return bool
     */
    public function can(OrderStorage $order, string $action): bool
    {
        // Получаем текущий статус заказа
        $status = $order->getStatus()->value;

        // Проверяем, существует ли переход для данного статуса и действия
        return isset($this->transitions[$status][$action]);
    }

    /**
     * Получить следующий статус для действия.
     *
     * @param OrderStorage $order
     * @param string $action
     * @return OrderStatusEnum|null
     * @throws DomainException
     */
    public function getNextStatus(OrderStorage $order, string $action): ?OrderStatusEnum
    {
        $status = $order->getStatus()->value;

        // Проверяем, существует ли переход для данного статуса и действия
        if (!isset($this->transitions[$status][$action])) {
            // Если переход не найден, выбрасываем исключение
            throw new DomainException("Action '{$action}' cannot be performed on status '{$status}'.");
        }

        // Возвращаем новый статус как объект OrderStatusEnum
        return OrderStatusEnum::from($this->transitions[$status][$action]);
    }
}
