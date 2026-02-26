<?php

namespace App\Http\Controllers;

use App\Models\FeaturedWork;
use Illuminate\Http\Request;

class FeaturedWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FeaturedWork::all();

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
                'link' => 'nullable|string',
                'tag_ids' => 'nullable|array',
                'tag_ids.*' => 'nullable|integer|exists:project_tags,id',
                'about_work' => 'required|string',
                'tech_stack_ids' => 'nullable|array',
                'tech_stack_ids.*' => 'nullable|integer|exists:tech_stacks,id'
            ]);

            $baseData = [
                'title' => $request->title,
                'link' => $request->link,
                'tag_ids' => $request->tag_ids,
                'about_work' => $request->about_work,
                'tech_stack_ids' => $request->tech_stack_ids
            ];

            if($request->hasFile('image')) {
                $baseData['image'] = $this->imageUpload($request, 'image', 'uploads/featuredWork');
            }

            if(empty($request->featured_work_id)) {
                $result = FeaturedWork::create($baseData);
                $message = 'Sucessfully created';

            }else {
                $prev_data = FeaturedWork::findOrFail($request->featured_work_id);

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

        try {
            $data = FeaturedWork::findOrFail($id);

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

            $data = FeaturedWork::findOrFail($id);

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
