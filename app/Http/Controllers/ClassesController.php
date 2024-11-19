<?php

namespace App\Http\Controllers;

use App\Models\ClassAssign;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ClassesController extends Controller
{

    public function index()
    {

        if (\Auth::user()->can('manage class')) {
            if(\Auth::user()->type=='trainer'){
                $assignClass=ClassAssign::where('assign_id',\Auth::user()->id)->get()->pluck('classes_id')->toArray();
                $classes = Classes::whereIn('id', $assignClass)->get();
            }else{
                $classes = Classes::where('parent_id', parentId())->get();
            }
            return view('classes.index', compact('classes'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $days = Classes::$days;
        $trainer = User::where('parent_id', parentId())->where('type', 'trainer')->get()->pluck('name', 'id');
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');
        return view('classes.create', compact('days', 'trainer', 'trainee'));
    }


    public function store(Request $request)
    {

        if (\Auth::user()->can('create class')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'fees' => 'required',
                    'address' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $class = new Classes();
            $class->title = $request->title;
            $class->fees = $request->fees;
            $class->address = !empty($request->address) ? $request->address : null;
            $class->notes = !empty($request->notes) ? $request->notes : null;
            $class->parent_id = parentId();
            $class->save();

            if (count($request->days) > 0 && count($request->start_time) > 0 && count($request->start_time) > 0) {
                $start_time = $request->start_time;
                $end_time = $request->end_time;
                foreach ($request->days as $key => $day) {
                    $classSchedule = new ClassSchedule();
                    $classSchedule->classes_id = $class->id;
                    $classSchedule->days = $day;
                    $classSchedule->start_time = $start_time[$key];
                    $classSchedule->end_time = $end_time[$key];
                    $classSchedule->parent_id = parentId();
                    $classSchedule->save();
                }
            }

            if(!empty($request->trainer)){
                foreach ($request->trainer as $trainerId){
                    $assignTrainer=new ClassAssign();
                    $assignTrainer->classes_id = $class->id;
                    $assignTrainer->assign_id = $trainerId;
                    $assignTrainer->assign_type = 'trainer';
                    $assignTrainer->save();
                }
            }

            if(!empty($request->trainee)){
                foreach ($request->trainee as $traineeId){
                    $assignTrainee=new ClassAssign();
                    $assignTrainee->classes_id = $class->id;
                    $assignTrainee->assign_id = $traineeId;
                    $assignTrainee->assign_type = 'trainee';
                    $assignTrainee->save();
                }
            }
            return redirect()->route('classes.index')->with('success', __('Class successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($id )
    {
        $classes=Classes::find(Crypt::decrypt($id));
        return view('classes.show', compact('classes'));
    }


    public function edit($id)
    {
        $classes = Classes::find($id);

        $days = Classes::$days;
        $trainer = User::where('parent_id', parentId())->where('type', 'trainer')->get()->pluck('name', 'id');
        $trainee = User::where('parent_id', parentId())->where('type', 'trainee')->get()->pluck('name', 'id');

        return view('classes.edit', compact('days', 'trainer', 'trainee', 'classes'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('create class')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'fees' => 'required',
                    'address' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $classes=Classes::find($id);
            $classes->title = $request->title;
            $classes->fees = $request->fees;
            $classes->address = !empty($request->address) ? $request->address : null;
            $classes->notes = !empty($request->notes) ? $request->notes : null;
            $classes->save();

            if (count($request->days) > 0 && count($request->start_time) > 0 && count($request->start_time) > 0) {
                $id = $request->id;
                $start_time = $request->start_time;
                $end_time = $request->end_time;
                foreach ($request->days as $key => $day) {
                    if (isset($id[$key]) && !empty($id[$key])) {
                        $classSchedule = ClassSchedule::find($id[$key]);
                    } else {
                        $classSchedule = new ClassSchedule();
                        $classSchedule->parent_id = parentId();
                        $classSchedule->classes_id = $classes->id;
                    }

                    $classSchedule->days = $day;
                    $classSchedule->start_time = $start_time[$key];
                    $classSchedule->end_time = $end_time[$key];
                    $classSchedule->save();
                }
            }
            return redirect()->back()->with('success', __('Class successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete class') ) {
            $classes=Classes::find($id);
            $classes->delete();
            if(!empty($classes)) {
              ClassSchedule::where('classes_id', $id)->delete();
            }
            return redirect()->route('trainees.index')->with('success', __('Class successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function scheduleDestroy(Request $request)
    {
        if(!empty($request->id)){
            $schedule = ClassSchedule::find($request->id);
            $schedule->delete();
        }
        return 1;
    }

    public function userAssign($class_id,$user_type)
    {
        $assigned=ClassAssign::where('classes_id',$class_id)->get()->pluck('assign_id');
        if($user_type=='trainee'){
            $user='Trainee';
            $users = User::where('parent_id', parentId())->whereNotIn('id',$assigned)->where('type', 'trainee')->get()->pluck('name', 'id');
        }else{
            $user='Trainer';
            $users = User::where('parent_id', parentId())->whereNotIn('id',$assigned)->where('type', 'trainer')->get()->pluck('name', 'id');
        }
        return view('classes.user_assign', compact( 'users','class_id','user_type','user'));
    }

    public function userAssignStore(Request $request,$class_id,$user_type)
    {
        foreach ($request->user as $user){
            $assign=new ClassAssign();
            $assign->classes_id=$class_id;
            $assign->assign_type=$user_type;
            $assign->assign_id=$user;
            $assign->save();
        }

        return redirect()->back()->with('success', __('User successfully assigned.'));
    }

    public function userAssignRemove($id)
    {
        $assign = ClassAssign::find($id);
        $assign->delete();
        return redirect()->back()->with('success', __('User successfully removed.'));
    }
}
