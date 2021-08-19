<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $classes = Classroom::all();
        $grades = Grade::all();

        return view('pages.My_Classes.My_Classes', compact('grades', 'classes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ClassroomRequest $request)
    {

        try {
            DB::beginTransaction();

            $List_Classes = $request->List_Classes;
            foreach ($List_Classes as $List_Class) {
                $class = new Classroom();
                $class->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $class->Grade_id = $List_Class['Grade_id'];
                $class->save();
            }


            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('Classrooms.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(ClassroomRequest $request)
    {
        try {
            DB::beginTransaction();

            $class = Classroom::findorfail($request->id);
            $class->update([

                $class->Name_Class = ['en' => $request->Name_en, 'ar' => $request->Name],
                $class->Grade_id = $request->Grade_id,
            ]);
            DB::commit();
            toastr()->success(__('messages.Update'));
            return redirect()->route('Classrooms.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $class = Classroom::findorfail($request->id)->delete();
        toastr()->error(__('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }

}

?>
