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

            $result = MyWork::create($baseData);

            return response()->json([
                'success' => true,
                'message' => 'Successfully created',
                'data' => $result
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => $th->getMessage()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
