<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:setting-list|setting-create|setting-edit|setting-delete', ['only' => ['index','store']]);
         $this->middleware('permission:setting-create', ['only' => ['create','store']]);
         $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:setting-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'title' => 'required',
        ]);
    
        $input = $request->all();
        
        $input['title'] = strtoupper($request->input('title'));
        $setting = Setting::create($input);
    
        return redirect()->route('settings.index')
                        ->with('success','Setting created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        
        $this->validate($request, [
            'type' => 'required',
            'title' => 'required',
        ]);
    
        $input = $request->all();
        $input = $request->except(['_token', '_method']);
        $id = $setting->uuid;
        $input['title'] = strtoupper($request->input('title'));
        Setting::where('uuid', $id)->update($input); 
    
        return redirect()->route('settings.index')
                        ->with('success','Setting Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
