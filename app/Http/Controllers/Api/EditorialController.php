<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditorialRequest;
use App\Models\Book;
use App\Models\Editorial;
use Exception;

class EditorialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $editorial = Editorial::all();

            return $this->successResponse($editorial);
        } catch (Exception $th) {
            return $this->errorMessage([
                "Message" => $th->getMessage()
            ], 500);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditorialRequest $request)
    {

        try {

            $editorial = new Editorial();
            $editorial->name    = $request->name;
            $editorial->address = $request->address;
            $editorial->country = $request->country;

            if ($editorial->save()) {
                return $this->successResponse($editorial);
            } else {
                return $this->errorMessage([
                    "Message" => "Error inserting record"
                ], 200);
            }
        } catch (Exception $th) {
            return $this->errorMessage([
                "Message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $editorial = Editorial::find($id);

            if (!$editorial) {
                $editorial = [];
            }

            return $this->successResponse($editorial);
        } catch (Exception $th) {
            return $this->errorMessage([
                "Message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(EditorialRequest $request, $id)
    {

        try {

            $editorial = Editorial::find($id);

            if ($editorial) {
                $editorial->name    = isset($request->name) ? $request->name : $editorial->name;
                $editorial->address = isset($request->address) ? $request->address : $editorial->address;
                $editorial->country = isset($request->country) ? $request->country : $editorial->country;

                if ($editorial->save()) {
                    return $this->successResponse($editorial);
                } else {
                    return $this->errorMessage([
                        "Message" => "Error update record"
                    ], 200);
                }
            } else {
                return $this->errorMessage([
                    "Message" => "Does not exist"
                ], 200);
            }
        } catch (Exception $th) {
            return $this->errorMessage([
                "Message" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $editorial = Editorial::find($id);
            $passes = Book::select('editorial_id')->where('editorial_id', $id)->limit(1)->get();       

            if( $passes->isEmpty()){
                if ($editorial) {
                    $editorial->delete();
    
                    if ($editorial) {
                        return $this->successResponse(["Deleted successfully "]);
                    } else {
                        return $this->errorMessage([
                            "Message" => "Failed to delete record"
                        ], 200);
                    }
                } else {
                    return $this->errorMessage([
                        "Message" => "Does not exist"
                    ], 200);
                }
            }else{
                return $this->errorMessage([
                    "Message" => "The record cannot be deleted because it is being used elsewhere."
                ], 200);
            }
        
        } catch (Exception $th) {
            return $this->errorMessage([
                "Message" => $th->getMessage()
            ], 500);
        }
    }
}
