<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }
    public function index()
    {
        if (Auth::check()) {
            $user = $this->user;
            // dd($user);
            if ($user->is_super_admin) {
                $products = Product::orderBy('created_at', 'desc')->get();
                // dd($client);
                return view('products.index', compact('products'));
            } else {
                Auth::logout();

                return redirect()->back()->with('error', 'Unathorized access');
            }
        } else {

            return view('auth.login');
        }
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $user = $this->user;
        $request->validate([
            // 'org_name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'price' => 'required',
            'goal' => 'required',
            'description' => 'required',
            // 'password' => 'required|confirmed',

        ]);
        $new_product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'goal' => $request->goal,
            'description' => $request->description,

        ]);

        if ($request->hasFile('image')) {
            $slug = Str::slug($new_product->name) . "-";
            $myimage = $slug . time() . '.' . $request->image->getClientOriginalExtension();
            $path = 'uploads/product';
            $image = $request->file('image');

            // Store the image in the storage disk
            $imagePath = $image->storeAs($path, $myimage, 'public');

            // Save the image path to the $newproduct->image field
            $new_product->image = $imagePath;
            $new_product->save();
        }

        return redirect()->route('index-product')->with('success', 'Product Created SuccessFully');
    }
    public function edit($id)
    {
        // $id= base64_decode($id);
        $user = Product::findOrFail($id);
        return view('products.edit', compact('user'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $id = base64_decode($request->id);
        $product = Product::findOrFail($id);

        $request->validate([
            // 'org_name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'price' => 'required',
            'goal' => 'required',
            'description' => 'required',
            // 'password' => 'required|confirmed',

        ]);


        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'goal' => $request->goal,
            'description' => $request->description,
        ]);
        if ($request->hasFile('image')) {
            $slug = Str::slug($product->name) . "-";
            $myimage = $slug . time() . '.' . $request->image->getClientOriginalExtension();
            $path = 'uploads/product';
            $image = $request->file('image');

            // Store the image in the storage disk
            $imagePath = $image->storeAs($path, $myimage, 'public');

            // Save the image path to the $newproduct->image field
            $product->image = $imagePath;
            $product->save();
        }
        // $user->assignRole('HIMSubUser');
        return redirect()->route('index-product')->with('success', 'Product Updated SuccessFully');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $product = Product::find($request->id);

            if ($product->delete()) {
                return response()->json(['status' => 1, 'message' => 'Product Deleted Succcessfully']);
            } else {
                return response()->json(['status' => 0, 'message' => 'Unable to Delete Due to Unseen Errors']);
            }

    }
}
