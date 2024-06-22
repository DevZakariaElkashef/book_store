<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\College;
use App\Models\University;
use App\Exports\BooksExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreBookRequest;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $booksQuery = Book::query();
        $booksQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $booksQuery;

        if ($request->filled('from')) {
            $booksQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $booksQuery->whereDate('created_at', '<', $request->to);
        }

        if ($request->filled('subject_id')) {
            $booksQuery->where('subject_id', $request->subject_id);
        }

        if ($request->filled('college_id') || $request->filled('university_id')) {
            $booksQuery->whereHas('subject.college.university', function ($university) use ($request) {
                if ($request->filled('university_id')) {
                    $university->where('id', $request->university_id);
                }

                if ($request->filled('college_id')) {
                    $university->whereHas('colleges', function ($college) use ($request) {
                        $college->where('id', $request->college_id);
                    });
                }
            });
        }


        $books = $booksQuery->with('subject.college.university')->paginate(10);

        // Get counts without date range filtering
        $totalBooksCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalBooksCount ? ceil(($totalThisMonth / $totalBooksCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveBooksCount = $booksQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $booksQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveBooksCount ? ceil(($totalActiveThisMonth / $totalActiveBooksCount) * 100) : 0;

        $totalNotActiveBooksCount = $totalBooksCount - $totalActiveBooksCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveBooksCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveBooksCount) * 100) : 0;

        $universities = University::all();

        return view('dashboard.pages.books.index', compact('books', 'universities', 'totalBooksCount', 'thisMonthPercentage', 'totalActiveBooksCount', 'thisActiveMonthPercentage', 'totalNotActiveBooksCount', 'thisNotActiveMonthPercentage'));
    }


    public function search(Request $request)
    {
        $query = Book::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('name_en', 'like', '%' . $request->val . '%')
                    ->orWhere('description_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('description_en', 'like', '%' . $request->val . '%')
                    ->orWhere('author_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('author_en', 'like', '%' . $request->val . '%');
            });
        }

        $books = $query->paginate(10);

        return view('dashboard.pages.books.table', compact('books'))->render();
    }



    public function export()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return view('dashboard.pages.books.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->except('image');

        if ($request->has('image')) {
            $data['image'] = uploadeImage($request->image, "Books");
        }


        $book = Book::create($data);

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $book->images()->create(['path' => uploadeImage($image, "Books")]);
            }
        }

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('Book created successfully')
        ];

        return to_route('books.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('books.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $universities = University::all();

        return view('dashboard.pages.books.edit', compact('book', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->except('image');

        if ($request->has('image')) {

            $data['image'] = uploadeImage($request->image, "Books", $book->image);
        }

        $book->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('books.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('books.index')->with('message', $message);
    }

    public function delete(Request $request)
    {
        if (!$request->filled('ids')) {
            $message = [
                'status' => false,
                'content' => __('select some items')
            ];

            return back()->with('message', $message);
        }


        $ids = explode(',', $request->ids);
        Book::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
