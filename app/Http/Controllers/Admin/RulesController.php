<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RulesController extends Controller
{

    public function show()
    {
        return view('admin.rules', [
            'rules' => Rule::all()
        ]);
    }

    public function create()
    {
        return view('admin.rule');
    }

    public function edit($id)
    {
        return view('admin.rule', [
            'rule' => Rule::find($id)
        ]);
    }

    public function delete($id)
    {
        $rule = Rule::find($id);
        if (!$rule) {
            return abort(404);
        }

        $rule->delete();
        return redirect()
            ->to('/admin/rules')
            ->withErrors(['success' => "Rule deleted"]);
    }

    public function save(Request $r)
    {
        $inputs = $r->all();
        $validator = Validator::make(
            $inputs,
            [ // rules
                'id' => 'required|integer|min:0',
                'title' => 'required|string',
                'description' => 'required|string',
            ],
            [],
            []
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($inputs['id'] > 0) {
            // find existing rule given an id
            $rule = Rule::find($inputs['id']);
        } else {
            // create a new rule, id is invalid
            $rule = new Rule();
        }
        $rule->title = $inputs['title'];
        $rule->description = $inputs['description'];
        $rule->save();

        return redirect()
            ->to('/admin/rules')
            ->withErrors(['success' => "Rule created"]);
    }
}
