<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use GuzzleHttp\Psr7\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Handler\ApiResponseHandler;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;

class ProjectsController extends Controller
{
    protected $apiResponse;

    public function __construct()
    {
        $this->apiResponse = new ApiResponseHandler();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "Projects" => Projects::with('users')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectsRequest $request)
    {
        try {
            $project = Projects::create($request->validated());
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $project = Projects::with('users')->where('id', $request->id)->first();
            return response()->json([
                'project' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $projects)
    {
        try {
            $project = Projects::with('users')->where('id', $projects->id)->first();
            return response()->json([
                'project' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectsRequest  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectsRequest $request, Projects $projects)
    {
        try {
            $project = Projects::with('users')->where('id', $projects->id)->update($request->validated());
            if ($project) {
                $result = $this->apiResponse->SuccessResponse();
                return response()->json($result);
            }
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $projects)
    {
        try {
            $project = Projects::with('users')->where('id', $projects->id)->first()->delete();
            if ($project) {
                $result = $this->apiResponse->SuccessResponse();
                return response()->json($result);
            }
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        } catch (\Throwable $th) {
            $result = $this->apiResponse->errorResponse();
            return response()->json($result, $result['status']);
        }
    }
}
