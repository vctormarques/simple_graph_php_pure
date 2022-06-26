<?php

namespace App\GraphQL;

class AppType
{
    private static $appTypes = [];

    public static function cliente()
    {
        if (!isset(self::$appTypes['cliente'])) {
            self::$appTypes['cliente'] = new Types\ClienteType;
        }

        return self::$appTypes['cliente'];
    }

    public static function telefone()
    {
        if (!isset(self::$appTypes['telefone'])) {
            self::$appTypes['telefone'] = new Types\TelefoneType;
        }

        return self::$appTypes['telefone'];
    }

}