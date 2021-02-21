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
//        QUERY
//        $categories = DB::table('categories')
//            ->join('users', 'categories.user_id', 'users.id')
//            ->select('categories.*','users.name')
//            ->latest()->paginate(5);
//        $categories = DB::table('categories')->latest()->paginate(5);

        //ORM
        $categories = Category::latest()->paginate(5);//boshidan

//        $categories = Category::all(); // oxiridan


        return view('admin.category.index', compact('categories'));
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
}
