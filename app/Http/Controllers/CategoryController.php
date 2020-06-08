<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\CategorySave;
use DataTables;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view("categories.index", compact("categories"));
    }

    public function anyData()
    {
        return Datatables::of(Category::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => "required",
            "price" => "required|numeric",
            'category_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('category_logo')) {
            $image = $request->file('category_logo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('app');
            $image->move($destinationPath, $name);
            Category::create([
                "category_name" => $request->category_name,
                "price" => $request->price,
                "category_logo" => $name,
            ]);
            return redirect(url("categories"))->with('message', "Category saved successfully.");
        }
        return redirect()->back()->withErrors(["Problem, try again later."]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name' => "required",
            "price" => "required|numeric",
            'category_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $updated_fields = [
            "category_name" => $request->category_name,
            "price" => $request->price,
        ];

        if ($request->hasFile('category_logo')) {
            $image = $request->file('category_logo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('app');
            $image->move($destinationPath, $name);
            $updated_fields['category_logo'] = $name;
        }
        $category->update($updated_fields);
        return redirect(url("categories"))->with('message', "Category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(url("categories"))->with('message', "Category updated successfully.");
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id)->restore();
        dd($category);
    }

    public function getMac()
    {
//		$info = shell_exec("sudo arp-scan 192.168.200.0/24");
//		$info = shell_exec("nmap -n -sP 2.50.21.249/24");
//		$info = shell_exec("nbtstat -a 2.50.21.249");
//        $info = shell_exec("ping -4 192.168.23.216");
//        $info = shell_exec("arp -a 2.50.21.249");
//        $info = shell_exec("arping -A -I eth0 172.16.42.161");
        $info = shell_exec("arp -a -N 172.16.42.161");
        print_r($info);
    }

}
