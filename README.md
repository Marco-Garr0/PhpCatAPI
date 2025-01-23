# Cat API 

## Start up
The web server is Apache and the database is SQLite.
The project can be run with Docker.

    docker compose up --build

or just:

    docker compose up

## DB structure
```sql
CREATE TABLE cats(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(20),
    image BLOB,,
    age INTEGER,
    WhereWasFound TEXT,
    WhereWasSeen TEXT,
    sex BOOLEAN NOT NULL CHECK (sex IN (0, 1)),
    price INTEGER,
    color VARCHAR(15),
    weight INTEGER,
    breed VARCHAR(15)
);
```

## API

### GET /CatRouter.php?id={id}

#### Request
| Parameter | Type | Description        |
|-----------|------|--------------------|
| id        | int  | Cat id from the db |

**NOTE**: If the id is not present in the db,
the API will return all the cats in the db.

#### Response
```json
[
  {
    "id": 1,
    "name": "Alfonso",
    "image": "test",
    "age": 4,
    "whereWasFound": "Termoli",
    "whereWasSeen": "Bari",
    "sex": true,
    "price": 5,
    "color": "Daltonico",
    "weight": 59,
    "breed":"Pastore australiano"
  }
]
```

| Parameter     | Type    | Description                 |
|---------------|---------|-----------------------------|
| id            | int     | Cat id from the db          |
| name          | string  | Cat name                    |
| image         | string  | Cat image encoded in base64 |
| age           | int     | Cat age                     |
| whereWasFound | string  | Where the cat was found     |
| whereWasSeen  | string  | Where the Cat was seen      |
| sex           | boolean | cat sex                     |
| price         | int     | Cat price                   |
| color         | string  | Cat color                   |
| weight        | int     | Cat weight                  |
| breed         | string  | Cat breed                   |

### POST /CatRouter.php

#### Request
```json
{
    "id": 0,
    "name": "Alfonso",
    "image": "test",
    "age": 4,
    "whereWasFound": "Termoli",
    "whereWasSeen": "Bari",
    "sex": true,
    "price": 5,
    "color": "Daltonico",
    "weight": 59,
    "breed":"Pastore australiano"
}
```

| Parameter     | Type    | Description                 |
|---------------|---------|-----------------------------|
| id            | int     | Cat id from the db          |
| name          | string  | Cat name                    |
| image         | string  | Cat image encoded in base64 |
| age           | int     | Cat age                     |
| whereWasFound | string  | Where the cat was found     |
| whereWasSeen  | string  | Where the Cat was seen      |
| sex           | boolean | cat sex                     |
| price         | int     | Cat price                   |
| color         | string  | Cat color                   |
| weight        | int     | Cat weight                  |
| breed         | string  | Cat breed                   |

#### Response

```json
{
    "id": 1,
    "name": "Alfonso",
    "image": "test",
    "age": 4,
    "whereWasFound": "Termoli",
    "whereWasSeen": "Bari",
    "sex": true,
    "price": 5,
    "color": "Daltonico",
    "weight": 59,
    "breed":"Pastore australiano"  
}
```

| Parameter     | Type    | Description                  |
|---------------|---------|------------------------------|
| id            | int     | Cat id from the db           |
| name          | string  | Cat name                     |
| image         | string  | Cat image encoded in base 64 |
| age           | int     | Cat age                      |
| whereWasFound | string  | Where the cat was found      |
| whereWasSeen  | string  | Where the Cat was seen       |
| sex           | boolean | cat sex                      |
| price         | int     | Cat price                    |
| color         | string  | Cat color                    |
| weight        | int     | Cat weight                   |
| breed         | string  | Cat breed                    |

### PUT /CatRouter.php

#### Request
```json
{
    "id": 1,
    "name": "Alfonso",
    "image": "test",
    "age": 4,
    "whereWasFound": "Termoli",
    "whereWasSeen": "Bari",
    "sex": true,
    "price": 5,
    "color": "Daltonico",
    "weight": 59,
    "breed":"Pastore australiano"
}
```

#### Response

```json
{
    "id": 1,
    "name": "Alfonso",
    "image": "test",
    "age": 4,
    "whereWasFound": "Termoli",
    "whereWasSeen": "Bari",
    "sex": true,
    "price": 5,
    "color": "Daltonico",
    "weight": 59,
    "breed":"Pastore australiano"
}
```

| Parameter     | Type    | Description                 |
|---------------|---------|-----------------------------|
| id            | int     | Cat id from the db          |
| name          | string  | Cat name                    |
| image         | string  | Cat image encoded in base64 |
| age           | int     | Cat age                     |
| whereWasFound | string  | Where the cat was found     |
| whereWasSeen  | string  | Where the Cat was seen      |
| sex           | boolean | cat sex                     |
| price         | int     | Cat price                   |
| color         | string  | Cat color                   |
| weight        | int     | Cat weight                  |
| breed         | string  | Cat breed                   |

### DELETE /CatRouter.php?id={id}

#### Request
| Parameter | Type | Description        |
|-----------|------|--------------------|
| id        | int  | Cat id from the db |

#### Response
```json
{
  "deleted": true
}
```

| Parameter | Type    | Description            |
|-----------|---------|------------------------|
| deleted   | boolean | If the cat was deleted |

