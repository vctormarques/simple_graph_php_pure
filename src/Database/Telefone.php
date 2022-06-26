<?php

namespace App\GraphQL\Database;

use App\GraphQL\Connection;

class Telefone
{
    public static function byPerson($cliente_id, $info)
    {
        $pdo = Connection::get();

        $allowed_field = [
            'numero'
        ];
        $fields = $info->getFieldSelection();
        $sql = createSelectSql('telefone', $fields, $allowed_field, 'WHERE cliente=?');

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $cliente_id
        ]);
        return $stmt->fetchAll();
    }

    public static function all($info)
    {
        $pdo = Connection::get();

        $allowed_field = [
            'numero'
        ];
        $fields = $info->getFieldSelection();
        $sql = createSelectSql('telefone', $fields, $allowed_field);

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}