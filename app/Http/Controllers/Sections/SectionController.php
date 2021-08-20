<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSections;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();

        return view('pages.Sections.Sections', compact('grades', 'grades', 'list_Grades'));


    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where('Grade_id', $id)->pluck('Name_Class', 'id');
        return $list_classes;
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
    public function store(StoreSections $request)
    {

//
//        try {
//            DB::beginTransaction();
//
//            $List_Classes = $request->List_Classes;
//            foreach ($List_Classes as $List_Class) {
//                $Sections = new Section();
//                $Sections->Name_Section = ['en' => $List_Class['Name_Section_En'], 'ar' => $List_Class['Name_Section_Ar']];
//                $Sections->Grade_id = $List_Class['Grade_id'];
//                $Sections->Class_id = $List_Class['Class_id'];
//                $Sections->save();
//            }
//
//
//            DB::commit();
//            toastr()->success(__('messages.success'));
//            return redirect()->route('Sections.index');
//
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }

        try {

            DB::beginTransaction();

            $Sections = new Section();

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();


            DB::commit();
            toastr()->success(__('messages.success'));
            return redirect()->route('Sections.index');

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
    public function update(StoreSections $request)
    {
        try {
            DB::beginTransaction();

            $Sections = Section::findorfail($request->id);
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
                if (isset($request->Status)) {
                    $Sections->Status = 1;
                } else {
                    $Sections->Status = 2;
                }
             $Sections->save();



            DB::commit();
            toastr()->success(__('messages.Update'));
            return redirect()->route('Sections.index');

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
        $Sections = Section::findorfail($request->id)->delete();
        toastr()->error(__('messages.Delete'));
        return redirect()->route('Sections.index');

    }

}

?>
