# To-do API - Lumen

API simples de gerênciamento de afazeres, feita com Lumen PHP.

## Linguas (Languages)

- [Português](#documentação)
- [English](#documentation)

## Documentação

### Adiciona um item

```http
  POST /todos
```

| Parâmetro     | Tipo     | Descrição                           |
| :------------ | :------- | :---------------------------------- |
| `title`       | `string` | **Obrigatório**. Título do todo.    |
| `description` | `string` | **Obrigatório**. Descrição do todo. |

### Retorna o item em específico

```http
  GET /todos/${id}
```

| Parâmetro | Tipo  | Descrição                      |
| :-------- | :---- | :----------------------------- |
| `id`      | `int` | **Obrigatório**. O ID do item. |

### Atualiza o status do todo

```http
  PUT /todos/${id}/status
```

| Parâmetro | Tipo  | Descrição                      |
| :-------- | :---- | :----------------------------- |
| `id`      | `int` | **Obrigatório**. O ID do item. |

### Deleta um item específico

```http
  DELETE /todos/${id}
```

| Parâmetro | Tipo  | Descrição                      |
| :-------- | :---- | :----------------------------- |
| `id`      | `int` | **Obrigatório**. O ID do item. |

----------

## Documentation

### Add an item

```http
  POST /todos
```

| Parameter     | Type     | Description                     |
| :------------ | :------- | :------------------------------ |
| `title`       | `string` | **Required**. Todo title.       |
| `description` | `string` | **Required**. Todo description. |

### Get an item

```http
  GET /todos/${id}
```

| Parameter | Type  | Description            |
| :-------- | :---- | :--------------------- |
| `id`      | `int` | **Required**. Item ID. |

### Updates item status (done/undone)

```http
  PUT /todos/${id}/status
```

| Parameter | Type  | Description            |
| :-------- | :---- | :--------------------- |
| `id`      | `int` | **Required**. Item ID. |

### Deletes an item

```http
  DELETE /todos/${id}
```

| Parameter | Type  | Description            |
| :-------- | :---- | :--------------------- |
| `id`      | `int` | **Required**. Item ID. |

## Autores

- [@Jphn](https://www.github.com/Jphn)
