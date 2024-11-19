<?php

namespace App\Http\Controllers;

use App\Models\ClassAssign;
use App\Models\Classes;
use App\Models\TraineeDetail;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WorkoutController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage workout')) {
            if(\Auth::user()->type=='trainer'){
                $assignTrainee=TraineeDetail::where('trainer_assign',\Auth::user()->id)->get()->pluck('user_id')->toArray();
                $assignClass=ClassAssign::where('assign_id',\Auth::user()->id)->get()->pluck('classes_id')->toArray();

                $workouts = Workout::
                        where(function($query) use($assignTrainee){
                            $query->where('assign_to','trainee')->whereIn('assign_id',$assignTrainee);
                        })
                    ->orWhere(function($query) use($assignClass){
                            $query->where('assign_to','class')->whereIn('assign_id',$assignClass);
                        });
                $workouts=$workouts->get();
            }elseif(\Auth::user()->type=='trainee'){
                $assignClass=ClassAssign::where('assign_type','trainee')->where('assign_id',\Auth::user()->id)->get()->pluck('classes_id')->toArray();

                $workouts = Workout::
                        where(function($query){
                            $query->where('assign_to','trainee')->where('assign_id',\Auth::user()->id);
                        })
                    ->orWhere(function($query) use($assignClass){
                            $query->where('assign_to','class')->whereIn('assign_id',$assignClass);
                        });
                $workouts=$workouts->get();
            }else{
                $workouts = Workout::where('parent_id', parentId())->get();
            }
            return view('workout.index', compact('workouts'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $classes = Classes::where('parent_id', parentId())->get()->pluck('title', 'id');
        $classes->prepend(__('Select Class'), '');
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        $trainee->prepend(__('Select Trainee'), '');
        $activity = WorkoutActivity::where('parent_id', parentId())->get()->pluck('title', 'id');
        $days = Classes::$days;
        return view('workout.create', compact('trainee', 'classes', 'activity', 'days'));
    }


    public function store(Request $request)
    {

        if (\Auth::user()->can('create workout')) {
            $validator = \Validator::make(
                $request->all(), [
                    'assign_to' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $workout = new Workout();
            $workout->assign_to = $request->assign_to;
            $workout->assign_id = !empty($request->trainee) ? $request->trainee : $request->class;
            $workout->start_date = $request->start_date;
            $workout->end_date = $request->end_date;
            $workout->notes = $request->notes;

            $workout->parent_id = parentId();

            if (!empty($request->days)) {
                $activity = $request->activity;
                $weight = $request->weight;
                $sets = $request->sets;
                $reps = $request->reps;
                $rest = $request->rest;
                $workouts = [];
                foreach ($request->days as $key => $day) {
                    $data['days'] = $day;
                    $data['activity'] = $activity[$key];
                    $data['weight'] = $weight[$key];
                    $data['sets'] = $sets[$key];
                    $data['reps'] = $reps[$key];
                    $data['rest'] = $rest[$key];
                    $workouts[] = $data;
                }
                $workout->workout_history = json_encode($workouts);
            }

            $workout->save();

            return redirect()->route('workouts.index')->with('success', __('Workout successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id)
    {
        $workout=Workout::find(Crypt::decrypt($id));
        $histories=!empty($workout->workout_history)?json_decode($workout->workout_history):[];
        if (\Auth::user()->can('show workout')) {
            return view('workout.show', compact('workout','histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function edit(Workout $workout)
    {
        $classes = Classes::where('parent_id', parentId())->get()->pluck('title', 'id');
        $classes->prepend(__('Select Class'), '');
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        $trainee->prepend(__('Select Trainee'), '');
        $activity = WorkoutActivity::where('parent_id', parentId())->get()->pluck('title', 'id');
        $days = Classes::$days;
        $workoutHistory = !empty($workout->workout_history) ? json_decode($workout->workout_history) : [];
        return view('workout.edit', compact('trainee', 'classes', 'workout', 'activity', 'days', 'workoutHistory'));
    }


    public function update(Request $request, Workout $workout)
    {
        if (\Auth::user()->can('edit workout')) {
            $validator = \Validator::make(
                $request->all(), [
                    'assign_to' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $workout->assign_to = $request->assign_to;
            $workout->assign_id = !empty($request->trainee) ? $request->trainee : $request->class;
            $workout->start_date = $request->start_date;
            $workout->end_date = $request->end_date;
            $workout->notes = $request->notes;
            $workout->parent_id = parentId();

            if (!empty($request->days)) {
                $activity = $request->activity;
                $weight = $request->weight;
                $sets = $request->sets;
                $reps = $request->reps;
                $rest = $request->rest;
                $workouts = [];
                foreach ($request->days as $key => $day) {
                    $data['days'] = $day;
                    $data['activity'] = $activity[$key];
                    $data['weight'] = $weight[$key];
                    $data['sets'] = $sets[$key];
                    $data['reps'] = $reps[$key];
                    $data['rest'] = $rest[$key];
                    $workouts[] = $data;
                }
                $workout->workout_history = json_encode($workouts);
            }

            $workout->save();

            return redirect()->route('workouts.index')->with('success', __('Workout successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Workout $workout)
    {
        if (\Auth::user()->can('delete workout')) {
            $workout->delete();
            return redirect()->route('workouts.index')->with('success', __('Workout successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function todayWorkout()
    {
        if (\Auth::user()->can('manage today workout')) {
            if(\Auth::user()->type=='trainer'){
                $assignTrainee=TraineeDetail::where('trainer_assign',\Auth::user()->id)->get()->pluck('user_id')->toArray();
                $assignClass=ClassAssign::where('assign_id',\Auth::user()->id)->get()->pluck('classes_id')->toArray();

                $workouts = Workout::where('assign_to','trainee')->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))
                        ->where(function($query) use($assignTrainee){
                            $query->where('assign_to','trainee')->whereIn('assign_id',$assignTrainee);
                        });
                $workouts=$workouts->get();
            }elseif(\Auth::user()->type=='trainee'){
                $assignClass=ClassAssign::where('assign_type','trainee')->where('assign_id',\Auth::user()->id)->get()->pluck('classes_id')->toArray();

                $workouts = Workout::where('assign_to','trainee')->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))
                        ->where(function($query){
                            $query->where('assign_to','trainee')->where('assign_id',\Auth::user()->id);
                        });
                $workouts=$workouts->get();
            }else{
                $workouts = Workout::where('parent_id', parentId())->where('assign_to','trainee')->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->get();
            }


            return view('workout.today', compact('workouts'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
