<?php

namespace Kakadu\Yii2Enum;

/**
 * Class    Enum
 * @package Kakadu\Yii2Enum
 * @author  Konstantin Timoshenko
 * @author  Yarmaliuk Mikhail
 * @version 2.0
 *
 * @since   2.0 rename to Enum
 * @since   1.0 AbstractDictionary
 */
abstract class Enum
{
    /**
     * Default item
     *
     * @var array
     */
    protected static $notSetMessage = ['app', 'Не указано'];

    /**
     * Enum model attribute name
     *
     * @var string|NULL
     */
    protected static $attribute;

    /**
     * Get all items
     *
     * @return array
     *
     * @since 2.0 not abstract
     * @since 1.0 abstract function
     */
    public static function all(): array
    {
        return [];
    }

    /**
     * Enum constructor.
     *
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * Get all items keys
     *
     * @return array
     */
    public static function keys(): array
    {
        return \array_keys(static::all());
    }

    /**
     * Get title by vendor
     *
     * @param mixed $key
     *
     * @return string|NULL
     */
    public static function get($key): ?string
    {
        $key = \is_object($key) ? $key->{self::$attribute} : $key;

        return static::all()[$key] ?? static::getDefault();
    }

    /**
     * Get default item
     *
     * @return string
     */
    public static function getDefault(): string
    {
        [$category, $message] = static::$notSetMessage;

        return \Yii::t($category, $message);
    }

    /**
     * If model attribute has key
     *
     * @param mixed      $model
     * @param string|int $key
     *
     * @return bool
     */
    public static function has($model, $key): bool
    {
        if (\is_object($model)) {
            if ($attribute = static::$attribute) {
                return $model->$attribute == $key;
            }
        } else {
            return $model == $key;
        }

        return false;
    }

    /**
     * If model attribute has key in range
     *
     * @param mixed $model
     * @param array $keys
     *
     * @return bool
     */
    public static function hasIn($model, array $keys): bool
    {
        if (\is_object($model)) {
            if ($attribute = static::$attribute) {
                return \in_array($model->$attribute, $keys);
            }
        } else {
            return \in_array($model, $keys);
        }

        return false;
    }
}