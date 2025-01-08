<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreRequest;
use App\Models\GoogleDrive;
use App\Models\User;
use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh sách người dùng";
        $users = User::all();
        return view('pages.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm tài khoản người dùng";
        return view('pages.users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, GoogleDrive $googleDriveService)
    {
        $validatedData = $request->validated();

        // Xử lý description
        $description = $request->description;
        $dom = new \DOMDocument();
        $dom->loadHTML($description, 9);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time() . $key . '.png';

            \Storage::disk('public')->put($image_name, $data);
            $url = asset('http://127.0.0.1:8000/storage' . $image_name);
            $img->removeAttribute('src');
            $img->setAttribute('src', $url);
        }

        $avatarDriveId = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filePath = $avatar->getRealPath();
            $fileName = 'avatar_' . time() . '.' . $avatar->getClientOriginalExtension();
            $mimeType = $avatar->getMimeType();

            $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
            $response = $googleDriveService->uploadFile($filePath, $fileName, $mimeType, $folderId);

            $avatarDriveId = $response->id; // Hoặc $response->webViewLink nếu muốn lưu link
        }

        // Tạo user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'description' => $description,
            'avatar_url' => $avatarDriveId ? "https://drive.google.com/uc?id=" . $avatarDriveId : null,
        ]);

        // Xử lý kết quả
        if ($user instanceof Model) {
            toastr()->success('User created and avatar uploaded successfully!');
            return redirect()->route('users.index');
        }

        toastr()->error('An error occurred. Please try again later.');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $title = "Show user";
        return view('pages.users.show', compact('user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = "Edit user";
        return view('pages.users.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['name', 'email']));

        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user_delete =  $user->delete();
        if ($user_delete) {
            toastr()->success('Delete user successfully!');
        } else {
            toastr()->error('An error has occurred please try again later.');
        }
        return redirect()->route('users.index');
    }
}