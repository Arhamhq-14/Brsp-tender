<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;

class ClientController extends Controller
{
    public function index()
    {
        $tenders = Tender::where('archived','f')->latest()->get();
        return view('alltender',compact('tenders'));
    }


    public function archives()
    {
        $tenders = Tender::where('archived','t')->latest()->get();
        return view('archives',compact('tenders'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'apply_date' => 'required',
            'tender_id' => 'required',

        ]);

        $data_exists = Client::where('tender_id',$request->tender_id)->where('email',$request->email)->where('contact',$request->contact)->get();

        if($data_exists->isEmpty()){
            Client::create($validatedData);
        }



        $tender = Tender::where('uuid', $request->tender_id)->first();     
        $filePath = storage_path('app/' . $tender->document);
        $recipientEmail = $request->email;

        \Log::info("Attachment File Path: " . $filePath);

        if (!file_exists($filePath)) {
            \Log::error('File not found at: ' . $filePath); 
            return response()->json(['message' => 'File not found'], 404);
        }

        $originalFileName = basename($tender->document);

        try {
            Mail::send([], [], function ($message) use ($recipientEmail, $filePath,$originalFileName) {
                $message->from('salman.ahmed@brsp.org.pk', 'BRSP Tender-MIS')
                        ->to($recipientEmail)
                        ->subject('Tender PDF')
                        ->attach($filePath, [
                            'as' => $originalFileName,
                            'mime' => 'application/pdf', 
                        ]);
            });
    
            return redirect()->back()
            ->with('success', 'Tender document has been successfully sent to the given email address.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
        }
    }
}
