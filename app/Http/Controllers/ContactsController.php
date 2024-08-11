<?php


namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(Request $request)
    {
        // Start the query
        $query = DB::table("contacts");
    
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }
    
        // Sorting functionality
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $query->orderBy($sortBy, 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        // Get the contacts
        $contacts = $query->get();
    
        return view('contacts.index', ['contacts'=> $contacts]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:contacts',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'created_at' => 'nullable|date',  // Validation for created_at field
            ]);
    
            // If 'created_at' is not provided, set the current timestamp
            if (!isset($validatedData['created_at'])) {
                $validatedData['created_at'] = now();
            }

            // DB::table('contacts')->insert([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'phone' =>  $request->phone,
            //     'address' => $request->address
            // ]);

            DB::table('contacts')->insert($validatedData);
    
        //    DB::insert('insert into contacts (name, email, phone, address) value (?, ?, ?, ? )', [$request->name, $request->email, $request->phone, $request->address]);
    
            return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the contact.');
        }
    }

    public function show(Request $request)
    {
        $data = DB::table("contacts")->where("id", "=", $request->id)->first();
        return view('contacts.show', ['contact'=>$data]);
    }

    public function edit(Request $request)
    {
        $data = DB::table("contacts")->where("id", "=", $request->id)->first();
        return view('contacts.edit', ['contact'=>$data]);
    }

    public function update(Request $request)
    {
        $validateRequest = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:contacts',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
        ]);

        DB::table('contacts')->where('id', $request->id)
        ->update($validateRequest);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Request $request)
    {
        DB::table("contacts")->where('id', '=', $request->id)->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}

