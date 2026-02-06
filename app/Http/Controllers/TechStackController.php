<?php

namespace App\Http\Controllers;

use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{

    public function index()
    {
        $data = TechStack::all();

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
                'title'=>'required|string',
                'image'=>'required|image|mimes:jpg,jpeg,png,webp|max:1048',
            ]);

            $baseData = [
                'title' => $request->title
            ];

            if($request->hasFile('image')) {
                $baseData['image'] = $this->imageUpload($request, 'image', 'uploads/techStacks');
            }

            if(empty($request->tech_stack_id)) {
                $result = TechStack::create($baseData);
                $message = 'Sucessfully created';
            }else {
                $prev_data = TechStack::findOrFail($request->tech_stack_id);

                if(file_exists(public_path(@$prev_data->image)) && @$prev_data->image !=null && $request->hasFile('image')) {
                    unlink(public_path(@$prev_data->image));
                }

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
        $data = TechStack::findOrFail($id);

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

            $data = TechStack::findOrFail($id);

            if($data->image && file_exists(public_path($data->image))) {
                unlink(public_path($data->image));
            }

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
