<?php

namespace App\GraphQL\Types;

use App\GraphQL\AppType;
use App\GraphQL\Types\ClienteType;
use App\GraphQL\Database\Cliente;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class TelefoneType extends ObjectType
{
    public function __construct()
    {
        $config = $this->config();
        parent::__construct($config);
    }

    private function config()
    {
        return [
            'name' => 'telefone',
            'description' => 'Exibe os telefones',
            'fields' => [
                'id' => [
                    'type' => Type::id(),
                ],
                'numero' => [
                    'description' => 'Numero do telefone',
                    'type' => Type::string(),
                ]
            ],
            'resolveField' => function ($value, $args, $context, $info) {
                return $value[$info->fieldName];
            }
        ];
    }
}