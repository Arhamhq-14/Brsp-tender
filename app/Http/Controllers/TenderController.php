<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\Setting;
use App\Http\Requests\StoreTenderRequest;
use App\Http\Requests\UpdateTenderRequest;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:tender-list|tender-create|tender-edit|tender-delete', ['only' => ['index','store']]);
         $this->middleware('permission:tender-create', ['only' => ['create','store']]);
         $this->middleware('permission:tender-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tender-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $tenders = Tender::where('archived','f')->latest()->get();
        return view('tender.index',compact('tenders'));
    }

    public function archive()
    {
        $tenders = Tender::where('archived','t')->latest()->get();
        return view('tender.archive',compact('tenders'));
    }


    public function download($id)
    {
        $tender = Tender::findOrFail($id);
        if ($tender->document && Storage::exists($tender->document)) {
            return Storage::download($tender->document);
        }
        return redirect()->back()->with('error', 'File not found.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = Setting::where('type',1)->get();
        $donor = Setting::where('type',2)->get();
        return view('tender.create',compact(['project','donor']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenderRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reference_number' => 'required|string|unique:tenders,reference_number',
            'description' => 'required|string',
            'posting_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'document' => 'nullable|file|mimes:pdf|max:10240',
             'project'       => 'required|string',
              'donor'      => 'required|string',
        ]);

         $referenceNumber = $request->input('reference_number');

         $documentPath = null;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $originalFileName = $file->getClientOriginalName();
            $documentPath = $file->storeAs("tender_documents/{$referenceNumber}", $originalFileName);
        }


         Tender::create([
             'title' => $request->input('title'),
             'description' => $request->input('description'),
             'reference_number' => $referenceNumber,
             'created_by' => Auth::user()->uuid, 
             'posting_date' => $request->input('posting_date'),
             'start_date' => $request->input('start_date'),
             'end_date' => $request->input('end_date'),
             'project' => $request->input('project'),
            'donor' => $request->input('donor'),
            'type' => $request->input('type'),
            't_type' => $request->input('t_type'),
             'document' => $documentPath,
         ]);
 
         return redirect()->route('tenders.index')->with('success', 'Tender created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender)
    {
        return view('tender.show',compact('tender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tender $tender)
    {
        $project = Setting::where('type',1)->get();
        $donor = Setting::where('type',2)->get();
        return view('tender.edit',compact(['tender','project','donor']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenderRequest $request, Tender $tender)
    {
        $id = $tender->uuid;
        $request->validate([
            'title' => 'required|string|max:255',
            'reference_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tenders', 'reference_number')->ignore($id,'uuid'),
            ],
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:posting_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'document' => 'nullable|file|mimes:pdf|max:10240',
            'status' => 'required|integer|in:0,1',
            'project'       => 'required',
              'donor'      => 'required',
        ]);

            $tender = Tender::findOrFail($id);


            $documentPath = $tender->document; 
            if ($request->hasFile('document')) {
                if ($tender->document && Storage::exists($tender->document)) {
                    Storage::delete($tender->document);
                }

                $file = $request->file('document');
                $originalFileName = $file->getClientOriginalName();
                $documentPath = $file->storeAs("tender_documents/{$request->input('reference_number')}", $originalFileName);
            }


            $tender->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'reference_number' => $request->input('reference_number'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'document' => $documentPath,
                'archived' => $request->input('status'),
                'project' => $request->input('project'),
                'donor' => $request->input('donor'),
                'type' => $request->input('type'),
                't_type' => $request->input('t_type'),
            ]);

            return redirect()->route('tenders.index')->with('success', 'Tender updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender)
    {
        if ($tender && $tender->document) {
            Storage::delete($tender->document); 
            $tender->document = null;
            $tender->save();
        }
    
        return redirect()->back()->with('success', 'Document removed successfully.');
    }
}
