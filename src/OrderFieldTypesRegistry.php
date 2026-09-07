<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 28.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace SalesRender\Plugin\Addon\EnumFields;


use XAKEPEHOK\EnumHelper\EnumHelper;

class OrderFieldTypesRegistry extends EnumHelper
{
    const string ADDRESS = 'AddressOrderField';
    const string BOOLEAN = 'BooleanOrderField';
    const string DATETIME = 'DateTimeOrderField';
    const string EMAIL = 'EmailOrderField';
    const string ENUM = 'EnumOrderField';
    const string FILE = 'FileOrderField';
    const string FLOAT = 'FloatOrderField';
    const string HUMAN_NAME = 'HumanNameOrderField';
    const string IMAGE = 'ImageOrderField';
    const string INTEGER = 'IntegerOrderField';
    const string PHONE = 'PhoneOrderField';
    const string STRING = 'StringOrderField';
    const string URI = 'UriOrderField';
    const string USER = 'UserOrderField';

    public static function values(): array
    {
        return [
            self::ADDRESS,
            self::BOOLEAN,
            self::DATETIME,
            self::EMAIL,
            self::ENUM,
            self::FILE,
            self::FLOAT,
            self::HUMAN_NAME,
            self::IMAGE,
            self::INTEGER,
            self::PHONE,
            self::STRING,
            self::URI,
            self::USER,
        ];
    }
}