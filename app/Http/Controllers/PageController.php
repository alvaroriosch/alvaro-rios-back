<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Matriz;

class PageController extends Controller
{
  public static $INDEX_VIEW = "pages.index";
  public static $PROCESS_VIEW = "pages.process";
  public function index(Request $request)
  {
    return view(PageController::$INDEX_VIEW, []);
  }

  public function process(Request $request)
  {
    $request->validate([
      'size' => 'required|min:'.Matriz::$MIN_MATRIZ_SIZE.'|max:'.Matriz::$MAX_MATRIZ_SIZE
    ]);

    $input = $request->all();

    $results = [];

    $matriz = new Matriz(intval($input['size']));

    foreach ($input['action'] as $action)
    {
      if ($action['name'] == Matriz::$UPDATE_ACTION_NAME) {
        $matriz->update(
          intval($action['x']),
          intval($action['y']),
          intval($action['z']),
          intval($action['value'])
        );
      }
      if ($action['name'] == Matriz::$QUERY_ACTION_NAME) {
        $sum = $matriz->query(
          intval($action['x1']),
          intval($action['y1']),
          intval($action['z1']),
          intval($action['x2']),
          intval($action['y2']),
          intval($action['z2'])
        );
        array_push($results, $sum);
      }
    }

    return view(PageController::$PROCESS_VIEW, [
      'results' => $results
    ]);
  }
}
