<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrade;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades', compact('grades'));
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
    public function store(StoreGrade $request)
    {
        try {
            DB::beginTransaction();

            $grade = new Grade();
            $grade->name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->notes = $request->Notes;
            $grade->save();
            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('Grades.index');

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
    public function update(StoreGrade $request)
    {
        try {
            DB::beginTransaction();

            $grade = Grade::findorfail($request->id);
            $grade->update([

                $grade->name = ['en' => $request->Name_en, 'ar' => $request->Name],
            $grade->notes = $request->Notes ,
            ]);
            DB::commit();
            toastr()->success(__('messages.Update'));
            return redirect()->route('Grades.index');

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
        $grade = Grade::findorfail($request->id)->delete();
        toastr()->error(__('messages.Delete'));
        return redirect()->route('Grades.index');

    }

}

?>
