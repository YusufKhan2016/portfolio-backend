<?php

namespace App\Http\Controllers;

use App\Models\MyExperience;
use Illuminate\Http\Request;

class MyExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MyExperience::all();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'job_title'=>'required|string',
                'recruiter_name'=>'required|string',
                'from_year'=>'required|integer',
                'to_year'=>'nullable|integer|gte:from_year',
            ]);

            $baseData = [
                'job_title' => $request->job_title,
                'recruiter_name' => $request->recruiter_name,
                'from_year' => $request->from_year,
                'to_year' => $request->to_year,
            ];

            if(empty($request->experience_id)) {
                $result = MyExperience::create($baseData);
                $message = 'Sucessfully created';
            }else {
                $prev_data = MyExperience::findOrFail($request->experience_id);

                $prev_data->update($baseData);

                $result = $prev_data->fresh();
                $message = 'Sucessfully saved';
            }


            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $result
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = MyExperience::findOrFail($id);

        return response()->json([
            'success'=> true,
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $data = MyExperience::findOrFail($id);

            $data->delete();

            return response()->json([
                'success'=>true,
                'message' => 'Successfully deleted'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }
}
