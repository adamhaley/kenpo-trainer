<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all training sessions
        $data = TrainingSession::all();
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        //get a single training session
        $session = TrainingSession::find($request->id);
        $data = $session;
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //return json
        $data = $request->techniques;
        $data['success'] = 'true';
        try{
            $session = TrainingSession::create(
                [
                    'name' => $request->name,
                    'user_id' => 1, //hard coded for now, will be replaced with auth()->id() when auth is implemented
                    'description' => $request->description
                ]
            );

            $session->techniques()->attach($request->techniques);
            $session->save();
            $data['training_session_id'] = $session->id;

        } catch(\Exception $e){
            $data['success'] = 'false';
            $data['message'] = $e->getMessage();
        }

        return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingSession $session)
    {
        //update training session
        $session->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingSession $session)
    {
        //destroy the training session
        $session->delete();
    }

    /**
     * Endpoint to set technique done for this training session
     * @param Request $request
     */
    public function setTechniqueDone(Request $request)
    {
        $session = TrainingSession::find($request->training_session_id);
        $technique = $session->techniques()->find($request->technique_id);
        $technique->setDoneForTrainingSession($session);

        return response()->json(['success' => 'true']);

        //assert that the technique was set to done
        $this->assertDatabaseHas('technique_training_session', [
            'training_session_id' => $request->training_session_id,
            'technique_id' => $technique->id,
            'done' => 1
        ]);
    }


    /**
     * Endpoint to get a random technique that is not already set to done for the current session
     * @param Request $request
     */
    public function getRandomTechnique(Request $request)
    {
        $session = TrainingSession::find($request->training_session_id);
        $technique = $session->getRandomTechnique();
        return response()->json($technique);
    }
}
