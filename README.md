
# Laravel Repositories Extension

## Requirements

- Laravel [5.6](https://laravel.com/docs/5.6) or [5.7](https://laravel.com/docs/5.7).

## Installation

You should install the `sepiphy/laravel-repositories` dependency via Composer:

```bash
composer require sepiphy/laravel-repositories
```

Then, you have to add the `Sepiphy\Laravel\Repositories\RepositoryServiceProvider` class to the `config/app.php` configuration file.

```php
return [

    'providers' => [

        /*
         * Package Service Providers...
         */
        Sepiphy\Laravel\Repositories\RepositoryServiceProvider::class,

    ],

];
```

## Usage

Creating a specified repository interface.

```php
namespace App\Contracts\Repositories;

use Sepiphy\Laravel\Contracts\Repositories\Repository;

interface UserRepository extends Repository
{
    // Write your expected methods here...
}
```

Creating a specified repository class.

```php
namespace App\Repositories;

use App\Eloquent\User; // User extends Model
use Sepiphy\Laravel\Repositories\Repository as BaseRepository;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * {@inheritdoc}
     */
    public function getModelName()
    {
        return User::class;
    }

    // Define all abstract methods...
}
```

Registering container bindings (typically in service providers).

```php
$this->app->singleton(
    \App\Contracts\Repositories\UserRepository::class,
    \App\Repositories\UserRepository::class
);
```

For example, Using a repository inside a controller.

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\UserRepository;

class UserController extends Controller
{
    /** @var UserRepository */
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $this->users->paginate();

        return view('users.index', compact('users'));
    }
}
```

These are available methods:

```php
$repository->store($attributes);
$repository->update($model, $attributes);
$repository->destroy($model);
$repository->find($id, $columns = ['*']);
$repository->findOrFail($id, $columns = ['*']);
$repository->get($columns = ['*']);
$repository->paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null);
```
