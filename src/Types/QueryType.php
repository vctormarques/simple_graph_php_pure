<?php

namespace App\GraphQL\Types;

use App\GraphQL\Database\Cliente;
use App\GraphQL\Database\Telefone;
use App\GraphQL\AppType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = $this->config();
        parent::__construct($config);
    }


    private function config()
    {
        return [
            'name' => 'Query',
            'description' => 'Tipo raiz da API',
            'fields' => [
                'cliente' => [
                    'name' => 'cliente',
                    'type' => AppType::cliente(),
                    'description' => 'Busca um cliente',
                    'args' => [
                        'id' => Type::nonNull(Type::id())
                    ]
                ],
                'cliente_nome' => [
                    'name' => 'cliente_nome',
                    'type' => AppType::cliente(),
                    'description' => 'Busca um cliente por nome',
                    'args' => [
                        'nome' => Type::nonNull(Type::string())
                    ]
                ],
                'clientes' => [
                    'name' => 'clientes',
                    'type' => Type::listOf(AppType::cliente()),
                    'description' => 'Lista todos os clientes',
                ],
                'telefone' => [
                    'name' => 'telefone',
                    'type' => Type::listOf(AppType::telefone()),
                    'description' => 'Lista todos telefones',
                ]
            ],
            'resolveField' => function ($val, $args, $context, $info){
                $field = strtolower($info->fieldName);
                return $this->{$field}($val, $args, $context, $info);
            }
        ];
    }

    public function cliente($val, $args, $context, $info)
    {
        return Cliente::first($args['id'], $info);
    }

    public function cliente_nome($val, $args, $context, $info)
    {
        return Cliente::byName($args['nome'], $info);
    }

    public function clientes($val, $args, $context, $info)
    {
        return Cliente::all($info);
        // if(!isset($args['page'])){
        //     return Telefone::all($info);
        // }
        // $limit = $args['limit'] ?? 10;
        // $post = Telefone::paginate($args['page'], $limit, $info);
        // return $post;        
    }

    public function telefone($val, $args, $context, $info)
    {
        return Telefone::all($info);
    }
}