<?php

namespace App\Http\Controllers;
use App\Models\AppointmentLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
                $client = User::where('is_user', 1)->orderBy('created_at', 'desc')->get();
                // dd($client);
                return view('client.index', compact('client'));
            }elseif($user->is_dietician){
                $client = User::where('is_user', 1)->where('doctor_id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
                // dd($client);
                return view('client.index', compact('client'));
            }
            else {
                Auth::logout();

                return redirect()->back()->with('error', 'Unathorized access');
            }
        } else {

            return view('auth.login');
        }
    }

    public function create()
    {
        return view('client.create');
    }
    public function store(Request $request)
    {
        $user = $this->user;
        $request->validate([
            // 'org_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',

        ]);
        $new_user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->contact,
            'password' => Hash::make($request->password),
            'is_user' => 1,
            'is_dietician' => 0,
        ]);


        return redirect()->route('index')->with('success', 'Sub User Created SuccessFully');
    }
    public function profile()
    {
        // $id= base64_decode($id);
        $user = Auth::user();
        if ($user->is_dietician) {
            return view('dietician.edit', compact('user'));
        }
        return view('client.edit', compact('user'));
    }
    public function edit($id)
    {
        // $id= base64_decode($id);
        $user = User::findOrFail($id);
        return view('client.edit', compact('user'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $id = base64_decode($request->id);
        $user = User::findOrFail($id);
        if ($user->is_doctor) {
            // dd('okay');
            return redirect()->route('index')->with('warning', 'Something went wrong');
        } else {

            $request->validate([
                // 'org_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',

            ]);
            if (isset($request->password)) {
                $request->validate([
                    'password' => 'confirmed',
                ]);
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->contact,
                'is_doctor' => 1,

            ]);
            // $user->assignRole('HIMSubUser');
            return redirect()->route('index')->with('success', 'Sub User Updated SuccessFully');
        }
    }
    public function view($id)
    {
        // $id= base64_decode($id);
        $user = User::findOrFail($id);
        return view('client.show', compact('user'));
    }
    public function generate($id)
    {
        // $id= base64_decode($id);
        $user = User::findOrFail($id);
        $data = json_decode($user->routine);
        // dd($data->sunday);
        return view('client.generate', compact('user','data'));
    }
    public function storeDiet(Request $request)
    {
        $id = base64_decode($request->id);
        $user = User::findOrFail($id);
        if ($user->is_doctor) {
            // dd('okay');
            return redirect()->route('index')->with('warning', 'Something went wrong');
        } else {

            $request->validate([
                // 'org_name' => 'required',

                'sunday' => 'required',
                'monday' => 'required',
                'tuesday' => 'required',
                'wednesday' => 'required',
                'thursday' => 'required',
                'friday' => 'required',
                'saturday' => 'required',
                'remarks' => 'required',


            ]);
            $dataToStore = [
                'sunday' => $request->input('sunday'),
                'monday' => $request->input('monday'),
                'tuesday' => $request->input('tuesday'),
                'wednesday' => $request->input('wednesday'),
                'thursday' => $request->input('thursday'),
                'friday' => $request->input('friday'),
                'saturday' => $request->input('saturday'),
                'remarks' => $request->input('remarks'),
            ];

            // Convert the data to JSON
            $routineJson = json_encode($dataToStore);
            // dd($routineJson);
            // Store the JSON data in the user's medical history field
            $user->routine = $routineJson;
            if ($user->is_new) {
                $appointment = AppointmentLog::create([
                    'user_id' => $user->id,
                    'doctor_id' => $user->doctor_id,
                ]);
            }
            $user->is_new = 0;
            $user->save();



            // $user->assignRole('HIMSubUser');
            return redirect()->route('index')->with('success', 'Diet Plan generated successfully');
        }
    }
}
