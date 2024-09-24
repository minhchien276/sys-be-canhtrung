<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeNotificationEnum extends Enum
{
    const UserNotification = 0;
    const OrderNotification = 1;
    const DiscountNotification = 2;
}
