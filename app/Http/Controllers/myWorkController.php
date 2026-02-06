<?php

namespace App\Http\Controllers;

use App\Models\MyWork;
use Illuminate\Http\Request;

class myWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MyWork::all();

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
                $baseData['image'] = $this->imageUpload($request, 'image', 'uploads/myWork');
            }

            if(empty($request->work_id)) {
                $result = MyWork::create($baseData);
                $message = 'Sucessfully created';
            }else {
                $prev_data = MyWork::findOrFail($request->work_id);

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
        $data = MyWork::findOrFail($id);

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
        //
    }
}
