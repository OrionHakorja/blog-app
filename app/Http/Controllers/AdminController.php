<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve the search input from the request
        $search = $request->input('search');

        // Query the blogs where the name, description, or date matches the search term
        $blogs = Blog::query()
            ->where('name', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%")
            ->orWhere('date_posted', 'LIKE', "%$search%")
            ->paginate(); // Paginate the results

        // Pass the search results to the 'test' view
        return view('admin.dashboard')->with([
            'blogs' => $blogs
        ]);
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.dashboard')->with('success');
    }
}
