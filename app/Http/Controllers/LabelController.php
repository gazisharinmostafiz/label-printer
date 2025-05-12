<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use App\Models\Label; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
class LabelController extends Controller
{
    //

    /**
     * Show the form for creating a new label.
     */
    public function create()
    {
        // Fetch all products, ordered by name, for the dropdown in the form
        $products = Product::orderBy('name')->get();
        // Pre-fill the "Prepared by" name with the logged-in user's name
        $preparedByName = Auth::check() ? Auth::user()->name : '';

        // Return the 'create label' view, passing the products and prepared name
        //i'll create this view in a later step (e.g., resources/views/labels/create.blade.php)
        return view('labels.create', compact('products', 'preparedByName'));
    }

    /**
     * Store a newly created label in storage and show a printable view.
     */
    public function store(Request $request) // Or name it print(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'used_by' => 'nullable|string|max:255',
            'name' => 'required|string|max:255', // This is the "Prepared by (Name)" field
            'date' => 'required|date',
            'qty' => 'required|integer|min:1',
        ]);

        // Find the selected product
        $product = Product::findOrFail($validatedData['product_id']);

        // Create and store the new label in the database
        Label::create([
            'user_id' => Auth::id(), // The ID of the logged-in user
            'product_id' => $product->id,
            'used_by' => $validatedData['used_by'],
            'prepared_by_name' => $validatedData['name'],
            'date' => $validatedData['date'],
            'qty' => $validatedData['qty'],
        ]);

        // Pass the validated data to a print-specific view
        // i'll create this view later (resources/views/labels/print.blade.php)
        return view('labels.print', [
            'productName' => $product->name,
            'usedBy' => $validatedData['used_by'] ?? 'N/A',
            'preparedByName' => $validatedData['name'],
            'date' => Carbon::parse($validatedData['date'])->format('Y-m-d'), // Ensure consistent date format
            'qty' => $validatedData['qty'],
        ]);
    }
}
