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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request )
    {

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

        try(
            $session = TrainingSession::create([
                'date' => $request->date
            ]);
        )
        catch(\Exception $e){
            $data['success'] = 'false';
            $data['message'] = $e->getMessage();
        }
    )

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingSession $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingSession $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingSession $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingSession $session)
    {
        //
    }
}
