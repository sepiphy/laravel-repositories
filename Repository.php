<?php

/*
 * This file is part of the Sepiphy package.
 *
 * (c) Nguyễn Xuân Quỳnh <nguyenxuanquynh2210vghy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sepiphy\Laravel\Repositories;

use Illuminate\Database\Eloquent\Model;
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
        return $this->model()->create((array) $attributes);
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
    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model()->find($id, $columns);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model()->findOrFail($id, $columns);
    }

    /**
     * {@inheritdoc}
     */
    public function get($columns = ['*'])
    {
        return $this->model()->get($columns);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->model()->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Get the model instance.
     *
     * @return Model
     */
    public function model()
    {
        if (is_null($this->model)) {
            $this->model = $this->app->make($this->getModelName());
        }

        return $this->model;
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
