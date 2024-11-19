<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClassAssign;
use App\Models\Classes;
use App\Models\Membership;
use App\Models\Subscription;
use App\Models\TraineeDetail;
use App\Models\TrainerDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use DB;
class TraineeController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage trainee')) {
            if(\Auth::user()->type=='trainer'){
            //  $assignTrainee = TraineeDetail::get()->pluck('email', 'id','parent_name','address','dob','phone_number','membership_start_date','gender','membership_plan');
             $trainees = TraineeDetail::get()->pluck('email', 'id','parent_name','address','dob','phone_number','membership_start_date','gender','membership_plan');

               // $assignTrainee=TraineeDetail::where('trainer_assign',\Auth::user()->id)->get()->pluck('user_id')->toArray();
                // $trainees = User::whereIn('id', $assignTrainee)->get();
            }else{
                // $trainees = User::where('parent_id', parentId())->where('type', 'trainee')->get();
                $trainees = TraineeDetail::get();
                // dd($trainees);
            }
            return view('trainee.index', compact('trainees'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }

    }


    public function create()
    {
        $gender=User::$gender;
        $title =array('Mr','Mrs','Ms');
        $trainer=User::where('parent_id',parentId())->where('type','trainer')->get()->pluck('name','id');
        $trainer->prepend(__('Select Trainer'),'');

        $category = Category::get()->pluck('title', 'id');
        $category->prepend(__('Select Plan Type'),'');

        $classes=Classes::where('parent_id',parentId())->get()->pluck('title','id');
        $classes->prepend(__('Select Class'),'');

        $membership = Membership::get()->pluck('title', 'id');
        $membership->prepend(__('Select Membership'),'');

        return view('trainee.create',compact('gender','trainer','category','classes','membership','title'));
    }


    public function store(Request $request)
    {
        // dd($request);
        if (\Auth::user()->can('create user')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required', 
                    'dob' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'phone_number' => 'required',
                    'address' => 'required',
                    'category' => 'required',
                    'membership_plan' => 'required',
                    'height' => 'required',
                    'weight' => 'required',
                    'injuries' => 'required',
                    'medication' => 'required',
                    'membership_start_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '_' . $file->getClientOriginalName(); 
                $filePath = $file->storeAs('upload/profile', $filename);
                $file->move($filePath, $filename);
        
                $traineeDetail = new TraineeDetail();
                 $traineeDetail->title_id = $request->Title;
                $traineeDetail->name = $request->name;
                $traineeDetail->email = $request->email;
                $traineeDetail->dob = $request->dob;
                $traineeDetail->parent_name = $request->parent_name;
                $traineeDetail->gender = $request->gender;
                $traineeDetail->address = $request->address;
                $traineeDetail->category = $request->category;
                $traineeDetail->membership_plan = $request->membership_plan;
                $traineeDetail->membership_start_date = $request->membership_start_date;
                $traineeDetail->phone_number = $request->phone_number;
                $traineeDetail->height = $request->height;
                $traineeDetail->weight = $request->weight;
                $traineeDetail->injuries = $request->injuries;
                $traineeDetail->medication = $request->medication;
                $traineeDetail->fee = $request->fee;
                $traineeDetail->paymentmode = $request->paymentmode;
                $traineeDetail->age = $request->age;
                $traineeDetail->profile_picture = $filename;
                $traineeDetail->save();
            return redirect()->route('trainees.index')->with('success', __('Trainee successfully created.'));

            }
                

                // Retrieve and print the last query from the log
              //  dd(DB::getQueryLog());
            // $trainee->password = \Hash::make($request->password);
            // $trainee->type = !empty($userRole->name)?$userRole->name:'trainee';
            // $trainee->profile = 'avatar.png';
            // $trainee->lang = 'english';
            // $trainee->parent_id = parentId();
          

            // $trainee->assignRole($userRole);

            // $expiryDate=Membership::calculateExpiryDate($request->membership_start_date,$request->membership_plan);
            // if(!empty($trainee)){
            //     $traineeDetail = new TraineeDetail();
            //     $traineeDetail->user_id = $trainee->id;
            //     $traineeDetail->trainee_id =  $this->traineeNumber();
            //     $traineeDetail->dob = $request->dob;
            //     $traineeDetail->gender = $request->gender;
            //     $traineeDetail->age = $request->age;
            //     $traineeDetail->category = $request->category;
            //     $traineeDetail->trainer_assign = !empty($request->trainer_assign)?$request->trainer_assign:0;
            //     $traineeDetail->fitness_goal = !empty($request->fitness_goal)?$request->fitness_goal:'';
            //     $traineeDetail->country = !empty($request->country)?$request->country:'';
            //     $traineeDetail->state = !empty($request->state)?$request->state:'';
            //     $traineeDetail->city = !empty($request->city)?$request->city:'';
            //     $traineeDetail->zip_code = !empty($request->zip_code)?$request->zip_code:'';
            //     $traineeDetail->address = !empty($request->address)?$request->address:'';
            //     $traineeDetail->membership_plan = $request->membership_plan;
            //     $traineeDetail->membership_start_date = $request->membership_start_date;
            //     $traineeDetail->membership_expiry_date = $expiryDate;
            //     $traineeDetail->parent_id = parentId();
            //     $traineeDetail->status = 1;
            //     $traineeDetail->save();
            // }

            // if(!empty($request->assign_class)){
            //     $class=new ClassAssign();
            //     $class->classes_id = $request->assign_class;
            //     $class->assign_id = $trainee->id;
            //     $class->assign_type = 'trainee';
            //     $class->save();

            // }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($ids)
    {
        $id=Crypt::decrypt($ids);
        // $trainee=User::find($id);
        $traineeDetail=TraineeDetail::where('id',$id)->first();
        // dd($traineeDetail);
        return view('trainee.show',compact('traineeDetail'));
    }


    public function edit($id) 
    {
        $gender=User::$gender;
        // $trainer=User::where('parent_id',parentId())->where('type','trainer')->get()->pluck('name','id');
        // $trainer->prepend(__('Select Trainer'),'');
        $title =array('Mr','Mrs','Ms');

        // $gender=User::$gender;
        // $trainee=User::find($id);
        $trainee=TraineeDetail::where('id',$id)->first();
        $category = Category::get()->pluck('title', 'id');
        $category->prepend(__('Select Plan Type'),'');

        $membership = Membership::get()->pluck('title', 'id');
        $membership->prepend(__('Select Membership'),'');

        $status = TraineeDetail::$status;

        return view('trainee.edit',compact('title','trainee','gender','category','membership','status'));
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit trainee')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'email' => 'required', 
                    'dob' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'phone_number' => 'required',
                    'address' => 'required',
                    'category' => 'required',
                    'membership_plan' => 'required',
                    'height' => 'required',
                    'weight' => 'required',
                    'injuries' => 'required',
                    'medication' => 'required',
                    'membership_start_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '_' . $file->getClientOriginalName(); 
                $filePath = $file->storeAs('upload/profile', $filename);
                $file->move($filePath, $filename);
                // $userRole =Role::where('parent_id',parentId())->where('name','trainee')->first();
                $traineeDetail = TraineeDetail::findOrFail($id);
                $traineeDetail->title_id = $request->Title;
                $traineeDetail->name = $request->name;
                $traineeDetail->email = $request->email;
                $traineeDetail->dob = $request->dob;
                $traineeDetail->parent_name = $request->parent_name;
                $traineeDetail->gender = $request->gender;
                $traineeDetail->address = $request->address;
                $traineeDetail->category = $request->category;
                $traineeDetail->membership_plan = $request->membership_plan;
                $traineeDetail->membership_start_date = $request->membership_start_date;
                $traineeDetail->phone_number = $request->phone_number;
                $traineeDetail->height = $request->height;
                $traineeDetail->weight = $request->weight;
                $traineeDetail->injuries = $request->injuries;
                $traineeDetail->medication = $request->medication;
                $traineeDetail->fee = $request->fee;
                $traineeDetail->paymentmode = $request->paymentmode;
                $traineeDetail->age = $request->age;
                $traineeDetail->profile_picture = $filename;
                $traineeDetail->save();
                return redirect()->route('trainees.index')->with('success', 'Trainee successfully updated.');

                }
            // $trainee->roles()->sync($userRole);

            // $expiryDate=Membership::calculateExpiryDate($request->membership_start_date,$request->membership_plan);
            // if(!empty($trainee)){
            //     $traineeDetail = TraineeDetail::where('user_id',$id)->first();
            //     $traineeDetail->dob = $request->dob;
            //     $traineeDetail->gender = $request->gender;
            //     $traineeDetail->age = $request->age;
            //     $traineeDetail->trainer_assign = !empty($request->trainer_assign)?$request->trainer_assign:0;
            //     $traineeDetail->fitness_goal = !empty($request->fitness_goal)?$request->fitness_goal:'';
            //     $traineeDetail->country = !empty($request->country)?$request->country:'';
            //     $traineeDetail->state = !empty($request->state)?$request->state:'';
            //     $traineeDetail->city = !empty($request->city)?$request->city:'';
            //     $traineeDetail->zip_code = !empty($request->zip_code)?$request->zip_code:'';
            //     $traineeDetail->address = !empty($request->address)?$request->address:'';
            //     $traineeDetail->category = $request->category;
            //     $traineeDetail->membership_plan = $request->membership_plan;
            //     $traineeDetail->membership_start_date = $request->membership_start_date;
            //     $traineeDetail->membership_expiry_date = $expiryDate;
            //     $traineeDetail->status = $request->status;
            //     $traineeDetail->save();
            // }

        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete trainee') ) {

            if(!empty($id)) {
                $trainerDetail = TraineeDetail::where('id', $id)->first();
                $trainerDetail->delete();
            }

            return redirect()->route('trainees.index')->with('success', __('Trainee successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    function traineeNumber()
    {
        $latest = TraineeDetail::where('parent_id', parentId())->latest()->first();
        if (!$latest) {
            return 1;
        }
        return $latest->trainee_id + 1;
    }
}
