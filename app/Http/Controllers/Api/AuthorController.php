<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Models\Book;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $author = Author::all();

            return $this->successResponse($author);
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
    public function store(AuthorRequest $request)
    {
        try {

            $author = new Author();
            $author->name       = $request->name;
            $author->last_name  = $request->last_name;

            if ($author->save()) {
                return $this->successResponse($author);
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

            $author = Author::find($id);

            if (!$author) {
                $author = [];
            }


            return $this->successResponse($author);
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
    public function update(AuthorRequest $request, $id)
    {
        try {

            $author = Author::find($id);


            $author->name       = isset($request->name) ? $request->name : $author->name;
            $author->last_name  = isset($request->last_name) ? $request->last_name : $author->last_name;

            if ($author->save()) {
                return $this->successResponse($author);
            } else {
                return $this->errorMessage([
                    "Message" => "Error update record"
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

            $author = Author::find($id);
            $passes = Book::select('author_id')->where('author_id', $id)->limit(1)->get();

            if ($passes->isEmpty()) {
                if ($author) {
                    $author->delete();
                    if ($author) {
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
            } else {
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
