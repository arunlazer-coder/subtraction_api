<?php

namespace App\Http\Controllers\maths;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Model\Maths as CurrentModel;
use Illuminate\Support\Facades\DB ;

class Listing extends ApiController
{

    public function index(Request $request)
    {

        $all = $request->all();

        $pageLimit = $this->defaultPageLimit;
        if (isset($all['pageLimit']) && isset($this->defaultPageLimitList[$all['pageLimit']])) {
            $pageLimit = $all['pageLimit'];
            $pageParams['pageLimit'] = $pageLimit;
        }

        $sortFields = $this->currentSortFields + $this->defaultSortFields;

        $sort = $this->defaultSort;
        if (isset($all['sort']) && isset($sortFields[$all['sort']])) {
            $sort = $all['sort'];
            $pageParams['sort'] = $sort;
        }
        $sortBy = $this->defaultSortBy;
        if (isset($all['sortBy'])) {
            $sortBy = $all['sortBy'];
            $pageParams['sortBy'] = $sortBy;
        }
        $sortField = str_replace('table.', 'tbl.', $sortFields[$sort]);

        $model = DB::table(CurrentModel::TN.' as tbl');

        if (isset($all['key'])) {
            $q = $all['key'];
            $model->where(function($query) use ($q) {
                $query->where('tbl.name', 'LIKE', '%'.$q.'%');
            });
        }
        if (isset($all['name'])) {
            $q = $all['name'];
            $model->where(function($query) use ($q) {
                $query->where('tbl.name', $q);
            });
        }
        if (isset($all['type'])) {
            $q = $all['type'];
            $model->where(function($query) use ($q) {
                $query->where('tbl.type', $q);
            });
        }
        if (isset($all['max'])) {
            $q = $all['max'];
            $model->where(function($query) use ($q) {
                $query->where('tbl.max', $q);
            });
        }
        if (isset($all['subType'])) {
            $q = $all['subType'];
            $model->where(function($query) use ($q) {
                $query->where('tbl.subType', $q);
            });
        }
        $model->selectRaw('tbl.*, tbl.created_at date');
        $model->orderBy($sort, $sortBy);
        $lists = $model->get();

        $json['items'] = $lists;
        $json['totalRecords'] = count($lists);

        $json['sort'] = $sort;
        $json['sortBy'] = $sortBy;

        return $this->responseJson($json);

    }
}
