<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModeloBase extends Model
{

    public function scopeFilterSortAndPaginate($query, Request $request, Array $filters = []) {
        $params  = $this->getParams($request);
        $filters = collect($filters);
        $query = $params->get('sorts')? $this->sortQuery($query, $params->get('sorts')) : $query;
        $query = ($params->get('queries') && $filters->count())? $this->filterQuery($query, $params->get('queries')->first(), $filters) : $query;
        $query = $this->paginateDynaTable($query, $params->get('page'), $params->get('perPage'));
        return $query;
    }

    private function paginateDynaTable($query, $paginaActual, $registrosPorPagina) {
        $skip = ($paginaActual-1)*$registrosPorPagina;
        return $query->skip($skip)->take($registrosPorPagina);
    }

    private function getParams(Request $request) {
         return collect($request->only(['page', 'perPage', 'sorts', 'queries']))->map(function($param) {
              if (is_array($param))
                  return collect($param);
              return $param;
         });

    }

    private function sortQuery($query, $sort) {
        $sortBy = $sort->keys()->first();
        $sign   = $sort->first() == 1? 'ASC' : 'DESC';
        return $query->orderBy($sortBy, $sign);
    }

    private function filterQuery($query, $filter, $filters) {

        if ($filters->count() == 0) return $query;
        if ($filters->count() == 1)
            return $query->where($filters->get('0'), $filter);

        return $query->where(function($q) use($filter, $filters) {
            $filters->each(function($filterType, $key) use ($q, $filter) {
                $this->filterWhere($q, $filterType, $filter, $key);
            });
        });
    }

    private function filterWhere($q, $filterType, $filter, $key) {
        if($key == 0)
            $q->where($filterType,'like', "%$filter%");
        else
            $q->orWhere($filterType, 'like', "%$filter%");
    }
}
