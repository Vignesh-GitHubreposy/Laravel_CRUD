<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Customer::all();
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
    public function store(StoreCustomerRequest $request)
    {
        //dd($request->all());
        $request->validated($request->all());
        $img_file = $request->file('image');
        $extension = $img_file->getClientOriginalExtension();
        $filename = md5(time()).'.'.$extension;
        $path = $img_file->storeAs('public/profile',$filename);
        $store = Customer::create([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'image' => $img_file,
        ]);
        //dd($request,$path,$store);
        session()->flash('status', 'New Customer Added successfully!');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer,$id)
    {
        $editdata=$customer->where('id', $id)->get();
        session()->flash('editdata', $editdata);
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if($request->hasfile('image')){
            $img_file = $request->file('image');
            $extension = $img_file->getClientOriginalExtension();
            $filename = md5(time()).'.'.$extension;
            $path = $img_file->storeAs('public/profile',$filename);
            $file=$filename;
            Storage::delete($request->prev_image);
        }else{
            $file=$request->prev_image;
        }
        Customer::where('id',$request->id)->update([
            'name'=>$request->name,
            'mobile_no'=>$request->mobile_no,
            'email'=>$request->email,
            'address'=>Str::of($request->address)->trim(),
            'image'=>$file,
        ]);
        session()->flash('status', 'Updation successful!');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Customer::where('id',$id)->delete();
        session()->flash('status', 'Deleted successful!');
        return redirect('/');

    }
}
