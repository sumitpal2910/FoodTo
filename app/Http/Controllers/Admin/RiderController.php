<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Rider;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RiderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->user = Auth::guard('rider')->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Rider::withTrashed()->count();

        $states = State::get();
        return view('themes.admin.rider.index', compact('count', 'states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy($rider)
    {
        # get data
        $data = Rider::withTrashed()->findOrFail($rider);

        # delete
        $data->trashed() ? $data->forceDelete() : $data->delete();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'City deleted successfully', 'data' => $data]);
    }

    /**
     * restore soft deleted data
     */
    public function restore(Request $request, $rider)
    {
        # restore and get data
        $data = Rider::withTrashed()->findOrFail($rider)->restore();

        # return success json
        return response()->json(['status' => 'success', 'message' => 'Rider restored successfully', 'data' => $data]);
    }


    /**
     * change status
     */
    public function status(Request $request, $rider)
    {
        # get data
        $data = Rider::findOrFail($rider);

        # update status
        $data->status = $data->status === 1 ? 0 : 1;
        $data->save();

        return response()->json(['status' => 'success', 'message' => 'Rider Status Changed', 'data' => $data]);
    }

    public function allData(Request $request)
    {
        $cityId = $request->input('city_id');
        $status = $request->input('status');

        $condition = $cityId ? [['city_id', '=', $cityId]] : [];

        switch ($status) {
            case 1:
                $riders = Rider::with('city')->where($condition)->where('status', 1)->latest()->get();
                break;
            case 2:
                $riders = Rider::with('city')->where($condition)->where('status', 0)->latest()->get();
                break;
            case 3:
                $riders = Rider::with('city')->where($condition)->onlyTrashed()->latest()->get();
                break;

            default:
                $riders = Rider::with('city')->where($condition)->withTrashed()->latest()->limit(100)->get();
                break;
        }


        $response = $this->tableData($riders);


        return response()->json(['data' => $response]);
    }

    /**
     * Table data
     */
    protected function tableData($riders)
    {
        $response = [];
        # loop over all restaurants
        foreach ($riders as $key => $data) {
            # assign name
            $name = $data->trashed() ? "<del class='text-muted'>{$data->name} (Deleted)</del> " : $data->name;

            # assign phone
            $phone =  "{$data->phone} <br> {$data->alt_phone}";

            # last seen
            $lastSeen =  $data->last_seen ?  Carbon::createFromFormat('m/d/Y',  $data->last_seen)->diffForHumans() : "...";


            # image
            if ($data->thumbnail) {
                $image = "<img width='40px' src='" . Storage::url($data->thumbnail) . "'>";
            } else {
                $image = "<img width='40px' src='" . Storage::url('asset/default-user.png') . "'>";
            }

            # status
            if ($data->status === 0) {
                $status = "<span class='badge badge-pill badge-warning'>Inactive </span>";
            } else if ($data->status === 1) {
                $status = "<span class='badge badge-pill badge-success'>Active</span>";
            }

            # action button
            $action = '<div class="row">';

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
                '#' => $key + 1, 'image' => $image, 'name' => $name, 'phone' => $phone,
                'city' => $data->city->name, 'status' => $status, 'last seen' => $lastSeen,  'action' => $action
            ];
            array_push($response, $tableData);
        }

        return $response;
    }
}
