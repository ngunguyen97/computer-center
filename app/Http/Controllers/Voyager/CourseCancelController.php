<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class CourseCancelController extends VoyagerBaseController
{
  use BreadRelationshipParser;

  public function index(Request $request)
  {
    // GET THE SLUG, ex. 'posts', 'pages', etc.
    $slug = "grades";

    // GET THE DataType based on the slug
    $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
    // Check permission
    auth()->user()->hasPermission('browse_course_cancel') ? : abort(403);


    $dataType->server_side = 0;


    $getter = $dataType->server_side ? 'paginate' : 'get';

    $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];

    $searchNames = [];
    if ($dataType->server_side) {
      $searchable = SchemaManager::describeTable(app($dataType->model_name)->getTable())->pluck('name')->toArray();
      $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->get();
      foreach ($searchable as $key => $value) {
        $field = $dataRow->where('field', $value)->first();
        $displayName = ucwords(str_replace('_', ' ', $value));
        if ($field !== null) {
          $displayName = $field->getTranslatedAttribute('display_name');
        }
        $searchNames[$value] = $displayName;
      }
    }

    $orderBy = $request->get('order_by', $dataType->order_column);
    $sortOrder = $request->get('sort_order', $dataType->order_direction);
    $usesSoftDeletes = false;
    $showSoftDeleted = false;

    // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
    if (strlen($dataType->model_name) != 0) {
      $model = app($dataType->model_name);

      if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
        $query = $model->{$dataType->scope}();
      } else {
        $query = $model::select('*');
      }

      // Use withTrashed() if model uses SoftDeletes and if toggle is selected
      if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
        $usesSoftDeletes = true;

        if ($request->get('showSoftDeleted')) {
          $showSoftDeleted = true;
          $query = $query->withTrashed();
        }
      }

      // If a column has a relationship associated with it, we do not want to show that field
      $this->removeRelationshipField($dataType, 'browse');

      if ($search->value != '' && $search->key && $search->filter) {
        $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
        $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
        $isRelation = false;
        $relationshipIds = [];

        foreach ($dataType->browseRows as $key => $row) {
          if ($row->type === 'relationship' &&
            $row->details->type === 'belongsTo' &&
            $row->details->column === $search->key
          ) {

            $relationshipIds = DB::table($row->details->table)
              ->select($row->details->key, $row->details->label)
              ->where($row->details->label, $search_filter, $search_value)
              ->pluck($row->details->key)
              ->toArray();

            $isRelation = true;
          }
        }

        if($isRelation) {
          $query->whereIn($search->key, $relationshipIds);
        } else {
          $query->where($search->key, $search_filter, $search_value);
        }
      }

      if ($orderBy && in_array($orderBy, $dataType->fields())) {
        $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
        $dataTypeContent = call_user_func([
          $query->orderBy($orderBy, $querySortOrder),
          $getter,
        ]);
      } elseif ($model->timestamps) {
        $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
      } else {
        $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
      }

      // Replace relationships' keys for labels and create READ links if a slug is provided.
      $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
    } else {
      // If Model doesn't exist, get data from table name
      $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
      $model = false;
    }

    // Check if BREAD is Translatable
    $isModelTranslatable = is_bread_translatable($model);

    // Eagerload Relations
    $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

    // Check if server side pagination is enabled
    $isServerSide = isset($dataType->server_side) && $dataType->server_side;

    // Check if a default search key is set
    $defaultSearchKey = $dataType->default_search_key ?? null;

    // Actions
    $actions = [];
    if (!empty($dataTypeContent->first())) {
      foreach (Voyager::actions() as $action) {
        $action = new $action($dataType, $dataTypeContent->first());

        if ($action->shouldActionDisplayOnDataType()) {
          $actions[] = $action;
        }
      }
    }

    // Define showCheckboxColumn
    $showCheckboxColumn = false;
    if (Auth::user()->can('delete', app($dataType->model_name))) {
      $showCheckboxColumn = true;
    } else {
      foreach ($actions as $action) {
        if (method_exists($action, 'massAction')) {
          $showCheckboxColumn = true;
        }
      }
    }

    // Define orderColumn
    $orderColumn = [];
    if ($orderBy) {
      $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
      $orderColumn = [[$index, $sortOrder ?? 'desc']];
    }

    $view = 'voyager::course-cancel.browse';


    $dataTypeContent->map(function($item) {
        return $item->load(['classroom', 'student']);
    });
    $searchNames = collect(['student_id', 'classroom_id']);

    return Voyager::view($view, compact(
      'actions',
      'dataType',
      'dataTypeContent',
      'isModelTranslatable',
      'search',
      'orderBy',
      'orderColumn',
      'sortOrder',
      'searchNames',
      'isServerSide',
      'defaultSearchKey',
      'usesSoftDeletes',
      'showSoftDeleted',
      'showCheckboxColumn'
    ));
  }

  public function destroy(Request $request, $id)
  {

    $slug = "grades";

    $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

    // Init array of IDs
    $ids = [];
    if (empty($id)) {
      // Bulk delete, get IDs from POST
      $ids = explode(',', $request->ids);
    } else {
      // Single item delete, get ID from URL
      $ids[] = $id;
    }
    foreach ($ids as $id) {
      $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

      $model = app($dataType->model_name);
      if (!($model && in_array(SoftDeletes::class, class_uses_recursive($model)))) {
        $this->cleanup($dataType, $data);
      }
    }

    $displayName = count($ids) > 1 ? $dataType->getTranslatedAttribute('display_name_plural') : $dataType->getTranslatedAttribute('display_name_singular');

    $res = $data->destroy($ids);
    $data = $res
      ? [
        'message'    => __('voyager::generic.successfully_deleted')." {$displayName}",
        'alert-type' => 'success',
      ]
      : [
        'message'    => __('voyager::generic.error_deleting')." {$displayName}",
        'alert-type' => 'error',
      ];

    if ($res) {
      event(new BreadDataDeleted($dataType, $data));
    }

    return redirect()->route("course.cancel.index")->with($data);
  }

}
