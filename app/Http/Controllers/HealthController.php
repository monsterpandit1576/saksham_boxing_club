<?php

namespace App\Http\Controllers;

use App\Models\Health;
use App\Models\TraineeDetail;
use App\Models\User;
use Illuminate\Http\Request;

class HealthController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage health update')) {
            if(\Auth::user()->type=='trainer'){
                $assignTrainee=TraineeDetail::where('trainer_assign',\Auth::user()->id)->get()->pluck('user_id')->toArray();
                $healthUpdates = Health::whereIn('user_id', $assignTrainee)->get();
            }elseif(\Auth::user()->type=='trainee'){

                $healthUpdates = Health::where('user_id',\Auth::user()->id)->get();
            }else{
                $healthUpdates = Health::where('parent_id', parentId())->get();
            }
            return view('health_update.index', compact('healthUpdates'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        $trainee->prepend(__('Select Trainee'), '');
        $measurement_type = Health::$measurement_type;
        return view('health_update.create', compact('trainee', 'measurement_type'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create health update')) {
            $validator = \Validator::make(
                $request->all(), [
                    'trainee' => 'required',
                    'measurement_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $health = new Health();
            $health->user_id = $request->trainee;
            $health->measurement_date = $request->measurement_date;
            $health->notes = $request->notes;
            $health->parent_id = parentId();

            if (!empty($request->type) && !empty($request->result)) {
                $result = $request->result;
                $history = [];
                foreach ($request->type as $key => $type) {
                    $data['type'] = $type;
                    $data['result'] = $result[$key];
                    $history[] = $data;
                }
                $health->result = json_encode($history);
            }

            $health->save();

            return redirect()->route('health-update.index')->with('success', __('Health update successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        $health = Health::find($id);
        $healthHistory = !empty($health->result) ? json_decode($health->result) : [];
        return view('health_update.show', compact('healthHistory', 'health'));
    }


    public function edit($id)
    {
        $health = Health::find($id);
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        $trainee->prepend(__('Select Trainee'), '');
        $measurement_type = Health::$measurement_type;
        $healthHistory = !empty($health->result) ? json_decode($health->result) : [];

        return view('health_update.edit', compact('trainee', 'measurement_type', 'healthHistory', 'health'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit health update')) {
            $validator = \Validator::make(
                $request->all(), [
                    'trainee' => 'required',
                    'measurement_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $health = Health::find($id);
            $health->user_id = $request->trainee;
            $health->measurement_date = $request->measurement_date;
            $health->notes = $request->notes;

            if (!empty($request->type) && !empty($request->result)) {
                $result = $request->result;
                $history = [];
                foreach ($request->type as $key => $type) {
                    $data['type'] = $type;
                    $data['result'] = $result[$key];
                    $history[] = $data;
                }
                $health->result = json_encode($history);
            }

            $health->save();

            return redirect()->route('health-update.index')->with('success', __('Health update successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete health update')) {
            $health = Health::find($id);
            $health->delete();
            return redirect()->route('health-update.index')->with('success', __('Health update successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
