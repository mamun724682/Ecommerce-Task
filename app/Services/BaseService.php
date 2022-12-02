<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @param $with
     * @return Builder|Builder|Collection|Model|void|null
     */
    public function get(int|null $id = null, string|array $with = []): Model|Collection
    {
        try {
            if ($id) {
                return $this->model::with($with)->findOrFail($id);
            } else {
                return $this->model::with($with)->get();
            }
        } catch (\Exception $e) {
            $this->logErrorResponse($e);
        }
    }

    /**
     * @param $data
     * @param $id
     * @return Model
     */
    public function storeOrUpdate(array $data, int $id = null): Model
    {
        try {
            if ($id) {
                // Update
                return tap($this->model::findOrFail($id))->update($data);
            } else {
                // Create
                return $this->model::create($data);
            }
        } catch (\Exception $e) {
            $this->logErrorResponse($e);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            return $this->model::findOrfail($id)->delete();
        } catch (\Exception $e) {
            $this->logErrorResponse($e);
        }
    }

    /**
     * @param $e
     * @return mixed
     */
    public function logErrorResponse($e)
    {
        throw $e;
    }
}
