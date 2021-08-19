<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectTrackingResource;
use App\Models\SubjectTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectTrackingController extends Controller
{
    /**
     * Display a listing of the subject tracking.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectTrackings = SubjectTracking::select(
            'subject_id',
            'latitude',
            'longitude',
            'unique_id',
            'date_time'
        )->get();

        $subjectTrackingsCollection = SubjectTrackingResource::collection($subjectTrackings);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject trackings retrieved successfully', $subjectTrackingsCollection);
        return response()->json($apiResponse, 200);
    }

    /**
     * Store a newly created subject tracking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validateData = [
            'subject_id' => 'exists:App\Models\Subject,id',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'unique_id' => 'string',
            'date_time' => 'date_format:Y-m-d H:i:s'
        ];

        $validator = Validator::make($data, $validateData);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $subjectTrackings = SubjectTracking::create($data);
        $subjectTrackingsResource = new SubjectTrackingResource($subjectTrackings);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject trackings created successfully', $subjectTrackingsResource);
        return response()->json($apiResponse, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Tracking anonymously
     *
     * @return \Illuminate\Http\Response
     */
    public function track_anonymously(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln(print_r($request->all(), true));

        return $this->store($request);
    }
}
