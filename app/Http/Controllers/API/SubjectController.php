<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    public const RECORDS_PER_PAGE = 20;

    /**
     * Display a list of subjects
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::select('subjects.*')
            ->paginate(self::RECORDS_PER_PAGE);

        $subjectsCollection = SubjectResource::collection($subjects);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subjects retrieved successfully', $subjectsCollection);
        return response()->json($apiResponse, 200);
    }

    /**
     * Store a newly created subject.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validationRules = [
            'first_name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'required|email|string',
            'nationality' => 'required|string|max:30',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_phone' => 'required|string|max:20',
            'id_number' => 'required|string|max:55',
            'id_type' => 'required|string|max:55',
            'unique_id' => 'string'
        ];

        $validator = Validator::make($data, $validationRules);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        if (!isset($data['unique_id'])) {
            $data['unique_id'] = Str::uuid();
        }

        $subject = Subject::create($data);
        $subjectsResource = new SubjectResource($subject);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject created successfully', $subjectsResource);
        return response()->json($apiResponse, 201);
    }

    /**
     * Display a specified subject
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subjectResource = new SubjectResource($subject);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject retrieved successfully', $subjectResource);
        return response()->json($apiResponse, 200);
    }

    /**
     * Update a specified subject.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        $updatedSubject = new SubjectResource($subject);

        if (!$updatedSubject) {
            $apiResponse = APIHelpers::formatAPIResponse(true, 'Subject update failed', null);
            return response()->json($apiResponse, 400);
        }

        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject updated successfully', $updatedSubject);
        return response()->json($apiResponse, 200);
    }

    /**
     * Remove a specified subject.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject deleted successfully', null);
        return response()->json($apiResponse, 204);
    }

    /**
     * Handles anonymous subject registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_anonymously(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln(print_r($request->all(), true));

        return $this->store($request);
    }
}
