<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    protected ?Team $team;

    private function setTeam()
    {
        $this->team = auth()->user()->team;
    }

    //
    public function getTeamMembers(Request $request)
    {
        $this->setTeam();

        $members = $this->team->members()->where('id','<>', auth()->user()->id)->get();

        return response()->json([
            'members' => $members
        ]);
    }

    public function createTeamMember(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $this->setTeam();

        $all = $request->all();

        $all['password'] = Hash::make($all['password']);

        $member = $this->team->members()->create($all);
        $member->assignRole($all['role']);

        return response()->json($member);
    }

    public function updateTeamMember(Request $request, int $id)
    {
        $rules = [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'nullable',
            'role' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $this->setTeam();

        $all = $request->all();

        if(!empty($all['password'])) {
            $all['password'] = Hash::make($all['password']);
        } else {
            unset($all['password']);
        }

        $member = $this->team->members()->findOrFail($id);
        $member->update($all);
        $member->assignRole($all['role']);

        return response()->json($member);
    }
}
