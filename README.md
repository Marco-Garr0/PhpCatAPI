# Cat API 

## DB structure
```sql
CREATE TABLE cats(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(20),
    age INTEGER,
    WhereWasFound TEXT,
    WhereWasSeen TEXT,
    sex BOOLEAN NOT NULL CHECK (sex IN (0, 1)),
    price INTEGER,
    color VARCHAR(15),
    weight INTEGER,
    breed VARCHAR(15)
);