<?PHP 

require __DIR__ . '/vendor/autoload.php';

if (!function_exists('creacteSelectSql')){
    function createSelectSql($table, $fields, $allowed_fields, $filter = ''){
        $sql_fileds = ['id'];

        foreach($fields as $key => $field){
            if(!in_array($key, $allowed_fields)){
                continue;
            }

            $sql_fileds[] = $key;
        }

        $sql_fields = implode(', ', $sql_fileds);

        $sql = [
            sprintf('SELECT %s FROM `%s`', $sql_fields, $table),
            $filter
        ];

        return implode(' ', $sql);
    }
}
require __DIR__ . '/graphql.php';