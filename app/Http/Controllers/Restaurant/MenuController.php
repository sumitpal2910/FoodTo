<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Common\MenuController as CommonMenuController;
use App\Models\Food;
use GuzzleHttp\RetryMiddleware;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('restaurant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Menu::where('restaurant_id', Auth::guard('restaurant')->id())->count();

        return view('themes.restaurant.menu.index', compact('count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods = $this->restaurnat()->foods;

        return view('themes.restaurant.menu.create', compact('foods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # get data
        $data = $request->all('title', 'summary');
        $data['slug'] = slug($data['title']);
        $data['restaurant_id'] = $this->restaurnat()->id;

        # create menu
        $menu =   Menu::create($data);

        # add food to menu
        $menu->foods()->attach($request->input('food_id'));

        return redirect()->route('restaurant.menu.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($menu)
    {
        # get menu
        $menu = Menu::with(['foods' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->withTrashed()->findOrFail($menu);

        # get foods id
        $foodId = [];

        foreach ($menu->foods as $key => $value) {
            array_push($foodId, $value->id);
        }

        # get foods that don't in this menu
        $foods = Food::where('restaurant_id', $this->restaurnat()->id)->whereNotIn('id', $foodId)->withTrashed()->orderBy('name', 'asc')->get();

        # show edit page
        return view('themes.restaurant.menu.edit', compact('menu', 'foods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $menuId)
    {
        # get menu
        $menu = Menu::where('restaurant_id', $this->restaurnat()->id)->withTrashed()->findOrFail($menuId);

        # validate
        $this->authorizeForUser($this->restaurnat(), 'update', $menu);

        # get input data
        $data = $request->all('title', 'summary');
        $data['slug'] = slug($data['title']);

        # update menu
        $menu->update($data);

        # update foods
        $menu->foods()->sync($request->input('food_id'));

        # return resposne
        return back()->with(['alert-type' => 'success', 'message' => 'Menu updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu)
    {
        # get menu
        $data = Menu::withTrashed()->findOrFail($menu);

        # authorize
        $this->authorizeForUser($this->restaurnat(), 'delete', $data);

        # delete
        if ($data->trashed()) {
            $data->foods()->detach();
            $data->forceDelete();
        } else {
            $data->delete();
        }

        # return resposne
        return response()->json(['status' => 'success', 'message' => 'Menu deleted', 'data' => $data]);
    }

    /**
     * Restore a soft deleted data
     */
    public function restore($menu)
    {
        # get menu
        $data = Menu::withTrashed()->findOrFail($menu);

        # authorize
        $this->authorizeForUser($this->restaurnat(), 'restore', $data);

        # restore
        if ($data->trashed()) $data->restore();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Menu restore', 'data' => $data]);
    }

    /**
     * Update status
     */
    public function updateStatus(Menu $menu)
    {
        # authorize
        $this->authorizeForUser($this->restaurnat(), 'update', $menu);

        # update
        $menu->status =  $menu->status === 0 ? 1 : 0;
        $menu->save();

        # return response
        return response()->json(['status' => 'success', 'message' => 'Menu status update', 'data' => $menu]);
    }

    /**
     * all data
     */
    public function allData()
    {
        # get menus
        $menus = Menu::with('foods')->where('restaurant_id', Auth::guard('restaurant')->id())->withTrashed()->get();

        # get table data
        $res = $this->tableData($menus);

        # return response
        return response()->json(['data' => $res]);
    }
    /**
     * get data table rows
     */
    protected function tableData($menus)
    {
        $response = [];

        # loop over all datas
        foreach ($menus as $key => $data) {
            # assign name
            $name = $data->trashed() ? "<del class='text-muted'>{$data->title} (Deleted)</del> " : $data->title;

            # assign summary
            $summary = $data->trashed() ? "<del class='text-muted'>{$data->summary} (Deleted)</del> " : $data->summary;

            # foods
            $foods = "<a href='#' data-toggle='modal' data-target='#foodModal' class='badge badge-pill badge-success showFood'
                            title='Show Foods' data='{$data->id}'>" . count($data->foods)  . "</a>";


            # status
            if ($data->status == 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            } else {
                $status = "<span class='badge badge-pill badge-warning'>Inactive</span>";
            }

            # action button
            $action = '<div class="row">
                           <a href="' . route('restaurant.menus.edit', ['menu' => $data->id]) .  '"
                               class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i></a>';

            if ($data->status == 1) {
                $action .=  '<button title="Inactive" type="button" data="' . $data->id . '" class="status btn btn-sm btn-outline-warning ml-3">
                                                <i class="fas fa-arrow-down"></i></button>';
            } else {
                $action .=  '<button title="Active" type="button" data="' . $data->id . '" class="status btn btn-sm btn-outline-success ml-3">
                                                <i class="fas fa-arrow-up"></i></button>';
            }

            $action .= '<button title="Delete" data="' . $data->id . '" class="delete btn btn-sm btn-outline-danger ml-3">
                               <i class="fas fa-trash"></i>
                           </button>
                       </div>';

            # deleted data action buttons
            if ($data->trashed()) {
                $action = '<div class="row">
                                <a href="' . route('restaurant.menus.edit', ['menu' => $data->id]) .  '"
                                    class="edit btn btn-sm btn-outline-info "><i class="fas fa-pencil-alt"></i>
                                </a>
                               <button title="Restore" data="' . $data->id . '" class="restore btn btn-sm btn-outline-primary ml-3">
                                   <i class="fas fa-trash-restore"></i>
                               </button>
                               <button title="Permanant Delete" data="' . $data->id . '" class="delete btn btn-sm btn-outline-danger ml-3">
                                   <i class="fas fa-trash"></i>
                               </button>
                           </div>';

                # status
                $status =  "<span class='badge badge-pill badge-danger'>Deleted</span>";
            };

            $tableData = [
                '#' => $key + 1,
                'name' => $name,
                'summary' => $summary,
                'foods' => $foods,
                'status' => $status,
                'action' => $action
            ];
            array_push($response, $tableData);
        }

        # return data
        return $response;
    }

    /**
     * Get Menu's Foods
     */
    public function foodData($menu)
    {
        # get data
        $data = Menu::with(['foods' => function ($q) {
            $q->withTrashed();
        }])->findOrFail($menu);

        # return response
        return response()->json(['status' => 'success', 'data' => $data]);
    }
}
