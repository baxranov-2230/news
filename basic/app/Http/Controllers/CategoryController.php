<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCat()
    {
//        QUERY - userlarni categoriyaga chiqarish
//        $categories = DB::table('categories')
//            ->join('users', 'categories.user_id', 'users.id')
//            ->select('categories.*','users.name')
//            ->latest()->paginate(5);
//        $categories = DB::table('categories')->latest()->paginate(5);

        //ORM
        $categories = Category::latest()->paginate(5);//boshidan
        $trachCat=Category::onlyTrashed()->latest()->paginate(3);

//        $categories = Category::all(); // oxiridan


        return view('admin.category.index', compact('categories','trachCat'));
    }

    public function AddCat(Request $request)
    {
        $validatedDate = $request->validate(
            [
                'category_name' => 'required|max:255',
            ],
            [
                'category_name.required' => 'Category kiriiting',
                'category_name.max' => 'harflar 255 dan oshib ketmasin',


            ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);


//         $category = new Category;
//         $category->category_name = $request->category_name;
//         $category->user_id = Auth::user()->id;
//         $category->save();

//        $data = array();
//        $data['category_name'] = $request->category_name;
//        $data['user_id'] = Auth::user()->id;
//        DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Categoriya omadli insert boldi');



    }

    public function Edit($id){
//        $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request, $id){
        //ROM
//        $update = Category::find($id)->update([
//            'category_name' =>$request->category_name,
//            'user_id' => Auth::user()->id
//
//
//        ]);

//        QUERY

        $data= array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return Redirect()->route('all.category')->with('success', 'Categoriya omadli yangilandi');
    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete');
    }

    public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore omadli');
    }

    public function Pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category  omadli ochirildi');
    }
}
