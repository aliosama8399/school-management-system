<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {

        return Teacher::all();

    }
    public function Getspecialization(){
        return specialization::all();
    }

    public function GetGender(){
        return Gender::all();
    }

    public function StoreTeachers($request){

        try {
            DB::beginTransaction();
            $Teachers = new Teacher();
            $Teachers->email = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.create');
        }
        catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    public function editTeachers($id)
    {
        return Teacher::findOrFail($id);
    }


    public function UpdateTeachers($request)
    {
        try {
            DB::beginTransaction();
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->email = $request->Email;
            $Teachers->password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function DeleteTeachers($request)
    {
        Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Teachers.index');
    }


}
