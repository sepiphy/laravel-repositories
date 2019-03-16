<?php declare(strict_types=1);

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sepiphy\Laravel\Repositories;

use Illuminate\Support\ServiceProvider;
use Sepiphy\Laravel\Repositories\Repository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving(function ($repository, $app) {
            if ($repository instanceof Repository) {
                $repository->setApplication($app);

                $repository->setModel(
                    $app->make($repository->getModelName())
                );
            }
        });
    }
}
