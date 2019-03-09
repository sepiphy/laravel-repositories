<?php

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Quynh Xuan Nguyen <seriquynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sepiphy\Laravel\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Sepiphy\Laravel\Support\Interaction\InteractsWithApplication;

abstract class Repository
{
    use InteractsWithApplication;

    /**
     * The Model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * Get the model name (could be a class name or a container identifier).
     *
     * @return string
     */
    abstract public function getModelName();

    /**
     * {@inheritdoc}
     */
    public function store($attributes)
    {
        return $this->model->create((array) $attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function update($model, $attributes)
    {
        $model->fill((array) $attributes)->save();

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * {@inheritdoc}
     */
    public function all($columns = ['*'])
    {
        return $this->newQuery()->all($columns);
    }

    /**
     * {@inheritdoc}
     */
    public function first($columns = ['*'])
    {
        return $this->newQuery()->first($columns);
    }

    /**
     * {@inheritdoc}
     */
    public function firstOrFail($columns = ['*'])
    {
        return $this->newQuery()->firstOrFail($columns);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $columns = ['*'])
    {
        return $this->newQuery()->find($id, $columns);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->newQuery()->findOrFail($id, $columns);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->newQuery()->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Get the new query builder.
     *
     * @return Builder
     */
    protected function newQuery()
    {
        return $this->model->query();
    }

    /**
     * Get the model instance.
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the model instance.
     *
     * @param  Model  $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }
}
