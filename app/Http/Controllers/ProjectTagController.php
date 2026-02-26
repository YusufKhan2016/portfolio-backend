<?php

namespace App\Http\Controllers;

use App\Models\ProjectTag;
use Illuminate\Http\Request;

class ProjectTagController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProjectTag::all();

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
                'tag_name'=>'required|string',
            ]);

            $baseData = [
                'tag_name' => $request->tag_name,
            ];

            if(empty($request->tag_id)) {
                $result = ProjectTag::create($baseData);
                $message = 'Sucessfully created';
            }else {
                $prev_data = ProjectTag::findOrFail($request->tag_id);

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
        try {
            $data = ProjectTag::findOrFail($id);

            return response()->json([
                'success'=> true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $data = ProjectTag::findOrFail($id);

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
