<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a paginated list of blogs belonging to the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Get the blogs associated with the user and paginate them (9 per page)
        $blogs = $user->blogs()->paginate(9);

        // Pass the paginated blogs to the 'blogs.index' view
        return view('blogs.index')->with([
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new blog.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the view to create a new blog
        return view('blogs.create');
    }

    /**
     * Store a newly created blog in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required'
        ]);

        // Create a new blog entry in the database
        Blog::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_posted' => now(),
            'user_id' => auth()->user()->id  // Assign the blog to the authenticated user
        ]);

        // Redirect to the 'test' route (presumably the main blog page)
        return redirect()->route('test');
    }

    /**
     * Show the form for editing the specified blog.
     *
     * @param  int  $id  The ID of the blog to edit.
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find the blog by ID or fail (404 error if not found)
        $blog = Blog::findOrFail($id);

        // Pass the blog data to the 'blogs.edit' view
        return view('blogs.edit')->with([
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified blog in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  The ID of the blog to update.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Find the blog by ID or fail
        $blog = Blog::findOrFail($id);

        // Validate the updated data
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required'
        ]);

        // Update the blog with the validated data
        $blog->update($data);

        // Redirect back to the blogs index page
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified blog from the database.
     *
     * @param  int  $id  The ID of the blog to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Find the blog by ID or fail
        $blog = Blog::findOrFail($id);

        // Delete the blog from the database
        $blog->delete();

        // Redirect back to the blogs index page
        return redirect()->route('blogs.index');
    }

    /**
     * Search for blogs based on the user's input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
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
        return view('test')->with([
            'blogs' => $blogs
        ]);
    }
}
