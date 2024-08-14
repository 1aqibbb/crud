<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        //only authenticated user can access
        $this->middleware('auth');
    }
    public function index()
    {
        // Fetch all dogs for the authenticated user
        $dogs = Dog::query()->where('user_id', auth()->id())->get();
        //return view with all fetched dogs
        return view('admin-panal.dog.index', compact('dogs'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'birth_year' => 'required|integer|between:2000,2030',
        ]);
        // Create a new dog record
        Dog::query()->create([
            'user_id' => auth()->id(),
            'name' => $validatedData['name'],
            'breed' => $validatedData['breed'],
            'birth_year' => $validatedData['birth_year'],
        ]);
        // Redirect or return a response
        return redirect()->back()->with('success', 'Dog added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'birth_year' => 'required|integer|between:1900,2099',
        ]);
        // Find the dog and update it
        $dog = Dog::findOrFail($id);
        $dog->update($validatedData);
        // Redirect back with success message
        return redirect()->route('dogs.index')->with('success', 'Dog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // app/Http/Controllers/DogController.php

    public function destroy($id)
    {
        try {
            // Find the dog by ID
            $dog = Dog::findOrFail($id);
            //delete the dog
            $dog->delete();
            // Redirect back with success message
            return redirect()->route('dogs.index')->with('success', 'Dog deleted successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Redirect back with error message if the dog is not found
            return redirect()->route('dogs.index')->with('error', 'Dog not found.');
        } catch (\Exception $e) {
            // Redirect back with error message for any other exceptions
            return redirect()->route('dogs.index')->with('error', 'Failed to delete dog.');
        }
    }

}
