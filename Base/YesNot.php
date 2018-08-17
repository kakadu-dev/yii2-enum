<?php
/**
 * Created by PhpStorm.
 * User: Yarmaliuk Mikhail
 * Date: 17.08.18
 * Time: 11:58
 */

namespace Kakadu\Yii2Enum\Base;

use Kakadu\Yii2Enum\Enum;

/**
 * Class    YesNot
 * @package Kakadu\Yii2Enum\Base
 * @author  Yarmaliuk Mikhail
 * @version 1.0
 */
class YesNot extends Enum
{
    const YES = 1;
    const NOT = 0;

    /**
     * @inheritdoc
     */
    public static function all(): array
    {
        return [
            self::YES => \Yii::t('app', 'Yes'),
            self::NOT => \Yii::t('app', 'Not'),
        ];
    }
}