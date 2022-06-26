### GraphQL com PHP Puro

- Repo básico de uma simples estrutura do graphql. 
- Com 2 tabelas e um relacionamento básico entre elas.
- 1 tabela de cliente
- 1 tabela de telefone e o vinculo de telefone x Cliente

### 🚀  Tecnologias Utilizadas
O projeto foi desenvolvido utilizando as seguintes tecnologias

- PHP 8.0
- PDO
- MySql
- [webonyx/graphql-php _ 14.11](https://github.com/webonyx/graphql-php)


#### Para realizar o cadatro
```
mutation createCliente($nome: String!, $idade: Int! ) {
  createCliente(nome: $nome, idade: $idade) {
    nome,
    idade
  }
}
```
#### Para realizar o update
```
mutation updateCliente($id: Int!, $nome: String!, $idade: Int! ) {
  updateCliente(id: $id, nome: $nome, idade: $idade) {
    id,
    nome,
    idade
  }
}
```

### Para realizar a busca de todos os dados
```
{
  clientes{
    id,
    nome,
    idade,
    data_nascimento,
    telefone{
      numero
    }
  }
}
```
