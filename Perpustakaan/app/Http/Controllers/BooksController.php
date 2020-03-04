<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Book;
use App\Helpers\User;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.books', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create_book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $imgName =  User::getFileName($request, 'image');
            User::uploadFile($request, 'image', $imgName, 350, 525, 'book_images');
            $data['image'] = $imgName;
            Book::create($data);

            alert()->success('Book Created Successfully', 'Thank You!')->persistent('OK');
            return redirect('books');
        } catch (Exception $e) {
            alert()->success('Book Failed to Create', 'Sorry!')->persistent('OK');
            return redirect('books')->with('status', 'Book Failed to Create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        if ($book) {
            return view('books.edit_book', ['book' => $book]);
        } else {
            return redirect('books');
        }
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
        try {
            $book = Book::find($id);
            $data = [
                'code' => $request->code,
                'title' => $request->title,
                'publisher' => $request->publisher,
                'author' => $request->author,
            ];

            if ($request->file('image')) {

                // Replace image old with image new
                if (Storage::exists('public/book_images/' . $book->image)) {
                    Storage::disk('public')->delete("book_images/" . $book->image);
                }
                $imgName = User::getFileName($request, 'image');
                User::uploadFile($request, 'image', $imgName, 300, 525, 'book_images');
                $data['image'] = $imgName;
            }
            $book->update($data);

            alert()->success('Book Updated Successfully', 'Thank You!')->persistent('OK');
            return redirect('books');
        } catch (Exception $e) {

            alert()->success('Book Failed to Update', 'Sorry!')->persistent('OK');
            return redirect('books');
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
            if (Storage::exists('public/book_images/' . $book->image)) {
                Storage::disk('public')->delete("book_images/" . $book->image);
            }
            $book->delete();

            alert()->success('Book Deleted Successfully', 'Thank You!')->persistent('OK');
            return redirect('books')->with('status', 'Book Deleted Successfully');
        } catch (Exception $e) {
            alert()->success('Book Failed to Delete', 'Sorry!')->persistent('OK');
            return redirect('books')->with('status', 'Book Failed to Delete');
        }
    }


    public function getBooks(Request $request)
    {
        $books = Book::all();
        $data = [];
        foreach ($books as $book) {
            $row['label'] = $book->code;
            $row['id'] = $book->id;
            $row['code'] = $book->code;
            $row['title'] = $book->title;
            $row['image'] = asset('storage/book_images/' . $book->image);
            $data[] = $row;
        }

        return json_encode($data);
        // $search = $request->term;
        // try {
        //     $books = Book::where('code', 'like', "%$search%")->orWhere('title', 'like', "%$search%")->get();
        //     $data = [];
        //     if ($books) {
        //         foreach ($books as $book) {
        //             $row['id'] = $book->id;
        //             $row['code'] = $book->code;
        //             $row['title'] = $book->title;
        //             $row['image'] = asset('storage/book_images/' . $book->image);
        //             $row['value'] = $book->code;
        //             $data[] = $row;
        //         }
        //     }
        //     return json_encode($data);
        // } catch (Exception $e) {
        //     return null;
        // }
    }
}
