<?php
/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 03.12.2018
 * Time: 12:44
 */

namespace Kakadu\Yii2Enum;

use yii\helpers\ArrayHelper;

/**
 * Trait    EnumTranslation
 * @package Kakadu\Yii2Enum
 * @author  Yarmaliuk Mikhail
 * @version 1.0
 */
trait EnumTranslation
{
    /**
     * Get translation config
     *
     * @param array $default
     *
     * @return array
     */
    public static function getConfig(array $default = []): array
    {
        \Yii::setAlias('@kkd-enum', dirname(__FILE__));

        return ArrayHelper::merge([
            'class'            => \yii\i18n\PhpMessageSource::class,
            'basePath'         => '@kkd-enum/messages',
            'sourceLanguage'   => 'en-US',
            'forceTranslation' => true,
        ], $default);
    }
}