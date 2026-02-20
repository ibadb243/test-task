<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Http\Resources\ResumeResource;
use App\Http\Requests\Resume\CreateRequest;
use App\Http\Requests\Resume\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResumeController extends Controller
{

    /**
     * @OA\Get(
     *     path="/resumes",
     *     summary="Get list of resumes",
     *     tags={"Resumes"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Resume"))
     *     )
     * )
     */
    public function index() : AnonymousResourceCollection {
        return ResumeResource::collection(Resume::latest()->paginate(15));
    }
    
    /**
     * @OA\Get(
     *     path="/resumes/{id}",
     *     summary="Get specific resume by ID",
     *     tags={"Resumes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the resume to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\JsonContent(ref="#/components/schemas/Resume")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resume not found"
     *      )
     * )
    */
    public function show(Resume $resume) : ResumeResource {
        return new ResumeResource($resume);
    }

    /**
     * @OA\Post(
     *     path="/resumes",
     *     summary="Create a new resume",
     *     tags={"Resumes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Resume")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Resume")
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(CreateRequest $request) : ResumeResource {
        $resume = Resume::create($request->validated());
        return new ResumeResource($resume);
    }

    /**
     * @OA\Put(
     *     path="/resumes/{id}",
     *     summary="Update an existing resume",
     *     tags={"Resumes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the resume to update",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Resume")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Resume")
     *      ),
     *      @OA\Response(response=422, description="Validation error")
     * )
    */
    public function update(UpdateRequest $request, Resume $resume) : ResumeResource {
        $resume->update($request->validated());
        return new ResumeResource($resume);
    }

    /**
     * @OA\Delete(
     *     path="/resumes/{id}",
     *     summary="Delete a resume",
     *     tags={"Resumes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the resume to delete",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Response(response=204, description="Deleted successfully"),
     *      @OA\Response(response=404, description="Resume not found")
     * )
    */
    public function destroy(Resume $resume) : \Illuminate\Http\Response {
        $resume->delete();
        return response()->noContent();
    }
}
