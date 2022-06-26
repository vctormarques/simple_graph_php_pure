<?php

namespace App\GraphQL\Database;

use App\GraphQL\Connection;

class cliente
{

    public static function first($id, $info)
    {
        $pdo = Connection::get();

        $allowed_field = [
            'nome',
            'data_nascimento',
            'idade'
        ];
        $fields = $info->getFieldSelection();
        $sql = createSelectSql('cliente', $fields, $allowed_field, 'WHERE id=?');

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch();
    }

    public static function byName($nome, $info)
    {
        $pdo = Connection::get();

        $allowed_field = [
            'nome',
            'data_nascimento',
            'idade'
        ];
        $fields = $info->getFieldSelection();
        $sql = createSelectSql('cliente', $fields, $allowed_field, 'WHERE nome =  ?');

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nome
        ]);
        return $stmt->fetch();
    }

    public static function paginate($page, $limit, $info)
    {
        $pdo = Connection::get();

        $allowed_field = [
            'nome',
            'data_nascimento',
            'idade'
        ];

        $offset = $limit * ($page - 1);

        $fields = $info->getFieldSelection();
        $sql = createSelectSql('cliente', $fields, $allowed_field, 'LIMIT ' . $offset . ', ' . $limit);

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function all($info)
    {
        $pdo = Connection::get();

        $allowed_field = [
            'nome',
            'data_nascimento',
            'idade'
        ];
        $fields = $info->getFieldSelection();
        $sql = createSelectSql('cliente', $fields, $allowed_field);

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function insert($nome, $idade)
    {
        $pdo = Connection::get();

        $sql = 'INSERT INTO `cliente` (`nome`, `data_nascimento`) values(?, ?);';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nome,
            $idade
        ]);

        $sql = 'SELECT * FROM `cliente` WHERE id=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $pdo->lastInsertId()
        ]);

        return $stmt->fetch();
    }
}