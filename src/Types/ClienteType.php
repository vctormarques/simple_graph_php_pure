<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\AppType;
use App\GraphQL\Database\Telefone;

class ClienteType extends ObjectType
{
    public function __construct()
    {
        $config = $this->config();
        parent::__construct($config);
    }

    private function config()
    {
        return [
            'name' => 'cliente',
            'description' => 'Exibe um cliente',
            'fields' => [
                'id' => [
                    'type' => Type::id(),
                ],
                'nome' => [
                    'description' => 'Nome do cliente',
                    'type' => Type::string(),
                ],
                'idade' => [
                    'description' => 'Idade do cliente',
                    'type' => Type::int(),
                ],
                'data_nascimento' => [
                    'description' => 'Data de Nascimento do cliente',
                    'type' => Type::string(),
                ],
                'telefone' => [
                    'description' => 'Telefone do cliente',
                    'type' => Type::listOf(AppType::telefone())
                ]
            ],
            'resolveField' => function ($value, $args, $context, $info) {
                if ($info->fieldName == 'telefone') {
                    return Telefone::byPerson($value['id'], $info);
                }
                return $value[$info->fieldName];
            }
        ];
    }
}