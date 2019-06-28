<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response()->json(Company::all(),200);
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'logo' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);


        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $request->logo,
            'description' => $request->description,
            'url' => $request->url
            
        ]);

        return response()->json(null, 200);
         /** 
        *return response()->json([
        *   'status' => (bool) $company,
        *   'data'   => $company,
        *   'message' => $company ? 'Company Created!' : 'Error Creating Company'
        *]);
         */
        
        }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
        return response()->json($company,200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        return response()->json($company,200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $status = $product->update(
            $request->only(['name', 'email', 'logo', 'description', 'url'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Company Updated!' : 'Error Updating Company'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $status = $company->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Company Deleted!' : 'Error Deleting Company'
        ]);
    }

    public function uploadFile(Request $request)
        {
            if($request->hasFile('logo')){
                $name = time()."_".$request->file('logo')->getClientOriginalName();
                $request->file('image')->move(public_path('images'), $name);
            }
            return response()->json(asset("images/$name"),201);
        }
    
}
