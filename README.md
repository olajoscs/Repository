
# Repository
This is a minimal Model/Repository package based on the [QueryBuilder](https://github.com/olajoscs/QueryBuilder) package.
Minimum requirements: PHP 5.5+ with the requirements of the [QueryBuilder](https://github.com/olajoscs/QueryBuilder).

# Model
To create a model which is handled by the repository, simply extend the Model class.

```
use OlajosCs\Repository\Model;
class MyModel extends Model {}
```

Then 3 methods has to be defined in the model:
- validate(): returns void, which should throw a ValidationExcpetion when an object is not completely ready to put into the database,
- static getTableName(): returns string, the name of the database table, which is related to the model,
- static getIdField(): returns string, which defines what the name of the ID field is in the database table.

# Repository
To create a repository which handles the model objects, simply extend the Repository class.
```
use OlajosCs\Repository\Repository
class MyObjectRepository extends Repository {}
```

There is only one method, which has to be defined:
- getModelClass(): string, returns the name of the class, which is the model. (MyModel::class)

# Functionality
- create(): Return a new, empty model
- get($id): Return a model, which has the ID of $id. If it does not exist, exception is thrown.
- getOrNew($id): Return a model, which has the ID of $id. If it does not exist, then a new empty one is returned.
- getList(): Return an array of all the models available in the database.
- save(Model $model): Save the model into the database. Create or update.
- delete(Model $model): Delete the model from the database.
- getWhereIdIn(array $ids): Return an array of the models, which have the ID listed in the array.
- getWhereIdInWithKeys(array $ids): Same as getWhereIdIn($ids), but the key of the returned array is the ID of the model.
