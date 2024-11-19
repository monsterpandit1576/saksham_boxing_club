<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage finance type')) {
            $types = Type::where('parent_id', parentId())->get();
            return view('type.index', compact('types'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function create()
    {
        $types=Type::$types;
        return view('type.create',compact('types'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create finance type')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $type = new Type();
            $type->title = $request->title;
            $type->type = $request->type;
            $type->parent_id = parentId();
            $type->save();

            return redirect()->route('types.index')->with('success', __('Type successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Type $type)
    {
        //
    }


    public function edit(Type $type)
    {
        $types=Type::$types;
        return view('type.edit', compact('type','types'));
    }


    public function update(Request $request, Type $type)
    {
        if (\Auth::user()->can('edit finance type')) {
            $validator = \Validator::make(
                $request->all(), [
                    'title' => 'required',
                    'type' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $type->title = $request->title;
            $type->type = $request->type;
            $type->save();

            return redirect()->route('types.index')->with('success', __('Type successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Type $type)
    {
        if (\Auth::user()->can('delete finance type') ) {
            $type->delete();
            return redirect()->route('types.index')->with('success', __('Type successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
