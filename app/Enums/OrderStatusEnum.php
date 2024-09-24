<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    const Pending = 1;          // Đang chờ xử lý
    const Confirmed = 2;        // Đã xác nhận
    const InTransit = 3;        // Đang vận chuyển
    const Delivered = 4;        // Đã giao hàng
    const Canceled = 5;         // Đã hủy
}
