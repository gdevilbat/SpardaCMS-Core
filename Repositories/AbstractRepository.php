<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Contract\BaseRepository;

use Auth;

/**
 * Class EloquentCoreRepository
 *
 * @package Gdevilbat\SpardaCMS\Modules\Core\Repositories\Eloquent
 */
abstract class AbstractRepository implements BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(\Illuminate\Database\Eloquent\Model $model, \Gdevilbat\SpardaCMS\Modules\Role\Repositories\Contract\AuthenticationRepository $acl)
    {
        $this->model = $model;
        $this->acl = $acl;
    }

    /**
     * @inheritdoc
     */
    final function find($id)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->find($id);
        }

        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    final function findOrFail($id)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->findOrFail($id);
        }

        return $this->model->findOrFail($id);
    }

    /**
     * @inheritdoc
     */
    final function all()
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at', 'DESC')->get();
        }

        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @inheritdoc
     */
    final function allWithBuilder() : Builder
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations');
        }

        return $this->model->query();
    }

    /**
     * @inheritdoc
     */
    final function paginate($perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy('created_at', 'DESC')->paginate($perPage);
        }

        return $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
    }

    /**
     * @inheritdoc
     */
    final function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    final function update($model, $data)
    {
        $model->update($data);

        return $model;
    }

    /**
     * @inheritdoc
     */
    final function destroy($model)
    {
        return $model->delete();
    }

    /**
     * @inheritdoc
     */
    final function allTranslatedIn($lang)
    {
        return $this->model->whereHas('translations', function (Builder $q) use ($lang) {
            $q->where('locale', "$lang");
        })->with('translations')->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @inheritdoc
     */
    final function findBySlug($slug)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug) {
                $q->where('slug', $slug);
            })->with('translations')->first();
        }

        return $this->model->where('slug', $slug)->first();
    }

    /**
     * @inheritdoc
     */
    final function findByAttributes(array $attributes)
    {
        $query = $this->buildQueryByAttributes($attributes);

        return $query->first();
    }

    /**
     * @inheritdoc
     */
    final function getByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder);

        return $query->get();
    }

    /**
     * Build Query to catch resources by an array of attributes and params
     * @param  array $attributes
     * @param  null|string $orderBy
     * @param  string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    final function buildQueryByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->model;

        if (method_exists($query, 'query')) {
            $query = $query->query();
        }

        if (method_exists($this->model, 'translations')) {
            $query = $query->with('translations');
        }

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        return $query;
    }

    /**
     * Build Query to catch resources by an array of attributes and params
     * @param  array $attributes
     * @param  null|string $orderBy
     * @param  string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    final function buildQueryByCreatedUser(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder);

        $authentication = 'read-'.$this->getModule();

        return $this->acl->getDataByCreatedUser($query, $this->model, $authentication);
    }

    final function with($relation)
    {
        $query = $this->model;

        if (method_exists($query, 'query')) {
            $query = $query->query();
        }

        return $query->with($relation);
    }

    /**
     * @inheritdoc
     */
    final function findByMany(array $ids)
    {
        $query = $this->model->query();

        if (method_exists($this->model, 'translations')) {
            $query = $query->with('translations');
        }

        return $query->whereIn("id", $ids)->get();
    }

    /**
     * @inheritdoc
     */
    final function clearCache()
    {
        return true;
    }

    final function getModule()
    {
        return $this->module;
    }

    final function setModule($module)
    {
        $this->module = $module;
    }

    final function setModel(\Illuminate\Database\Eloquent\Model $model)
    {
        $this->model = $model;

        return $this;
    }
}
