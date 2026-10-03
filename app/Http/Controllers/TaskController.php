<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()->get();
        return response()->json([
            'status_code' => 200,
            'message' => 'Task Fetched Successfully',
            'data' => $tasks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::query()->find($id);
        if (! $task) {
            return response()->json([
                'status_code' => 404,
                'message' => 'No Task Found',
                'data' => null,
            ], 404);
        }
        return response()->json([
            'status_code' => 200,
            'message' => 'Task Fetched Successfully',
            'data' => $task,
        ], 200);
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
