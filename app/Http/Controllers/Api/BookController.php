<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $query = Book::select('*');

            if ($request->has('author_id')) {

                $query->where('author_id', $request->author_id);
            }
            
            if ($request->has('editorial_id')) {
                
                $query->where('editorial_id', $request->editorial_id);
            }

            $books = $query->with('author')->with('editorial')->paginate(5);

            return  response($books, 200)->header('Content-Type', 'application/json');
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
    public function store(BookRequest $request)
    {
        try {

            $book = new  Book();
            $book->title    = $request->title;
            $book->description = $request->description;
            $book->year = $request->year;
            $book->author_id = $request->author_id;
            $book->editorial_id = $request->editorial_id;

            if ($book->save()) {
                return $this->successResponse($book);
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

            $book = Book::with('author')->with('editorial')->find($id);

            if (!$book) {
                $book = [];
            }

            return $this->successResponse($book);
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
    public function update(BookRequest $request, $id)
    {
        try {

            $book =  Book::find($id);
            $book->title        = $request->input('title', $book->title);
            $book->description  = $request->input('description', $book->description);
            $book->year         = $request->input('year', $book->year);
            $book->author_id    = $request->input('author_id', $book->author_id);
            $book->editorial_id = $request->input('editorial_id', $book->editorial_id);


            if ($book->save()) {
                return $this->successResponse($book);
            } else {
                return $this->errorMessage([
                    "Message" => "Error update record"
                ], 200);
            }
        } catch (Exception $e) {
            return $this->errorMessage([
                "Message" => $e->getMessage()
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

            $book = Book::find($id);

            if ($book) {
                $book->delete();

                if ($book) {
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
        } catch (Exception $th) {
            return $this->errorMessage([
                "Message" => $th->getMessage()
            ], 500);
        }
    }
}
