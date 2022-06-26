<?PHP 

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\GraphQL\AppType;
use App\GraphQL\Database\Cliente;
use App\GraphQL\Types\QueryType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


try {
    $schema = new Schema([
        'query' => new QueryType,
        'mutation' => new ObjectType([
            'name' => 'Mutations',
            'fields' => [
                'createCliente' => [
                    'type' => AppType::cliente(),
                    'args' => [
                        'name' => Type::nonNull(Type::string()),
                        'email' => Type::nonNull(Type::string()),                        
                    ],
                    'resolve' => function ($value, $args){
                        return Cliente::insert($args['nome'], $args['idade'], 1);
                    }
                ]
            ]
        ])
    ]);

    $input = file_get_contents('php://input');
    $input = json_decode($input, true);
    $query = $input['query'];
    $variables = $input['variables'] ?? null;

    $result = GraphQL::executeQuery($schema, $query, null, null, $variables);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage()
            ]
        ]
    ];
}

header('Content-Type: application/json');
echo json_encode($output);