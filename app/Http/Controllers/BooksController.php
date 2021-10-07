<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the book.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $books = User::find( auth()->user()->id )->books()->simplePaginate(5); 

            return view('books.index', compact('books'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else{
            return redirect('/user');
        }        
    }

    public function download($url){
        return response()->download(asset($url));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $uid = $user = auth()->user()->id;
            return view('books.create', ['uid' => $uid]);
        } else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'describe' => 'required',
            'url' => 'required'
        ]);

        $data = $request->all();
        $filename = $request->file('url')->getClientOriginalName();
        $file = $request->file('url');
        $upload_folder = 'public/books';

        Storage::putFileAs($upload_folder, $file, $filename);
        $data['url'] = $filename;

        Books::create($data);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Display the book.
     *
     * @param  \App\Models\books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(books $book)
    {
        return view('books.show', compact('book'));
    }

    public static function upload($book_id){
        $url = Books::find($book_id)->url;
        return response()->download('storage/books/'. $url);
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(books $book)
    {
        Storage::delete('public/books/'.$book->url);   
        $book->delete();

        return redirect()->route('books.index')
           ->with('success', 'Project deleted successfully');
    }
}
