<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Category;
use App\Models\Membership;
use App\Models\TraineeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MembershipController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage membership')) {
            $memberships = Membership::get();
            // $memberships = Membership::where('parent_id', parentId())->get();
            return view('membership.index', compact('memberships'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $package=Membership::$package;
        $category = Category::get()->pluck('title', 'id');
        $category->prepend(__('Select Plan Type'), '');
        $classes=Classes::where('parent_id',parentId())->get()->pluck('title','id');
        return view('membership.create', compact('package','classes','category'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create membership')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'package' => 'required',
                    'amount' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            // dd($request);
            $membership = new Membership();
            $membership->title = $request->title;
            $membership->package = $request->package;
            $membership->amount = $request->amount;
            $membership->category = $request->category;
            $membership->no_session = $request->no_session;
            // $membership->classes_id = !empty($request->classes_id) ? implode(',',$request->classes_id) : null;
            // $membership->notes = $request->notes;
            // $membership->parent_id = parentId();
            $membership->save();

            return redirect()->route('membership.index')->with('success', __('Member successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show($ids)
    {
        $id=Crypt::decrypt($ids);
        $membership=Membership::find($id);
        $trainees=TraineeDetail::where('membership_plan',$id)->get();
        return view('membership.show', compact('membership','trainees'));
    }


    public function edit(Membership $membership)
    {
        $classes=Classes::where('parent_id',parentId())->get()->pluck('title','id');
        $package=Membership::$package;
        $category = Category::get()->pluck('title', 'id');
        $category->prepend(__('Select Plan Type'),'');
        return view('membership.edit', compact('package','membership','classes','category'));
    }


    public function update(Request $request, Membership $membership)
    {
        // dd($membership);
        if (\Auth::user()->can('edit membership')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'package' => 'required',
                    'amount' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $membership->title = $request->title;
            $membership->package = $request->package;
            $membership->amount = $request->amount;
            $membership->category = $request->category;
            $membership->no_session = $request->no_session;
            $membership->save();

            return redirect()->route('membership.index')->with('success', __('Membership successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Membership $membership)
    {

        if (\Auth::user()->can('delete membership') ) {
            $membership->delete();
            return redirect()->route('membership.index')->with('success', __('Membership successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
