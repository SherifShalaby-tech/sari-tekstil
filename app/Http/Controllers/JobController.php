<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->can('employees_module.jobs.view')){
            abort(403, __('lang.unauthorized_action'));
        }
        $jobs=Job::latest()->get();
        return view('jobs.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_by']=Auth::user()->id;
            $color = Job::create($data);
            $output = [
                'success' => true,
                'id' => $color->id,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
        if ($request->quick_add) {
          return $output;
          }
        return redirect()->back()->with('status', $output);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->can('employees_module.jobs.edit')){
            abort(403, __('lang.unauthorized_action'));
        }
        $job = Job::find($id);
        return view('jobs.edit')->with(compact(
            'job'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, string $id)
    {
        try {
            $data['title'] = $request->title;
            $data['edited_by'] = Auth::user()->id;
            Job::find($id)->update($data);
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'msg' => __('lang.something_went_wrong')
            ];
        }
      
        return redirect()->back()->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->can('employees_module.jobs.delete')){
            abort(403, __('lang.unauthorized_action'));
        }
        try {
            $job=Job::find($id);
            $job->deleted_by=Auth::user()->id;
            $job->save();
            $job->delete();
            $output = [
                'success' => true,
                'msg' => __('lang.success')
            ];
          } catch (\Exception $e) {
              Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
              $output = [
                  'success' => false,
                  'msg' => __('lang.something_went_wrong')
              ];
          }
          return $output;
    }

}
