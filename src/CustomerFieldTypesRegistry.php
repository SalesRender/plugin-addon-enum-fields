<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 28.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace SalesRender\Plugin\Addon\EnumFields;


use XAKEPEHOK\EnumHelper\EnumHelper;

class CustomerFieldTypesRegistry extends EnumHelper
{
    const string ADDRESS = 'AddressCustomerField';
    const string BOOLEAN = 'BooleanCustomerField';
    const string DATETIME = 'DateTimeCustomerField';
    const string EMAIL = 'EmailCustomerField';
    const string ENUM = 'EnumCustomerField';
    const string FILE = 'FileCustomerField';
    const string FLOAT = 'FloatCustomerField';
    const string HUMAN_NAME = 'HumanNameCustomerField';
    const string IMAGE = 'ImageCustomerField';
    const string INTEGER = 'IntegerCustomerField';
    const string PHONE = 'PhoneCustomerField';
    const string STRING = 'StringCustomerField';
    const string URI = 'UriCustomerField';
    const string USER = 'UserCustomerField';

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