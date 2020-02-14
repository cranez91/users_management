<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    /** @var UserRepository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $newUser = $this->repository->create($data);
        return response()->json($newUser, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->except("_method");
        $user = $this->repository->update($data, $id);
        if (!$user) {
            return response()->json(null, 404); 
        }
        return response()->json($user, 200);
    }

    public function uploadFile(Request $request, $id)
    {
        if ($request->has('my_file')) {
           $file = $request->input('my_file');
           $user = $this->repository->find($id);
           $exists = Storage::disk('images')->exists($user->photo);
           if ($exists && ($user->photo !== "no-photo.jpg")) {
            Storage::disk('images')->delete($user->photo);
           }
           $newName = "{$user->id}_{$user->photo}";
           $data = ["photo" => $newName];
           $this->repository->update($data, $id);
           $image = imagecreatefromjpeg($file);
           $filename = public_path()."/images/{$newName}";
           imagejpeg( $image, $filename, 80);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->find($id);
        if (!$this->repository->delete($id)) {
            return response()->json(null, 404); 
        }
        if ($user->photo !== "no-photo.jpg") {
            Storage::disk('images')->delete($user->photo);
        }
        return response()->json(null, 204);
    }

    public function import(Request $request)
    {
        $encodedString = substr($request->input('file'),strpos($request->input('file'),",")+1);
        $encodedString = str_replace(' ','+',$encodedString);
        $decoded = base64_decode($encodedString);
        file_put_contents( public_path()."/files/file.csv",$decoded);
        Excel::import(new UsersImport, public_path()."/files/file.csv");
        return response()->json(null, 204);
    }
}
