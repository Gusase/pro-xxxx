<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\File;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Database\Query\Builder;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $data['jumlahPesan'] = $this->getJumlahPesan();
    $pesan = $this->getPesan();

    $groupedPesan = $pesan->groupBy('id_pengirim');
    $data['pesan'] = $pesan;
    $data['pesanGrup'] = $groupedPesan->all();

    $files = File::where('id_user', Auth::id());
    if (request('search')) {
      $files->where('judul_file', 'like', '%' . request('search') . '%')->orWhere('original_filename', 'like', '%' . request('search') . '%');
    }
    $data['files'] = $files->get();
    return view('user.index', $data);
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
  public function store(StoreUserRequest $request)
  {
    //
  }

  /**
   * nampilin data profil kita
   */
  public function show($param = null)
  {
    $userId = Auth::id();
    $username = Auth::user()->username;
    [$imageFile, $videoFile] = [[], []];

    if (is_null($param)) {
      $param = $userId;
    }

    $user = User::with(['files' => function (Builder $query) use ($param, $userId, $username) {
      /** @var Illuminate\Contracts\Database\Query\Builder $query */
      $query->when($param != $userId && $param != $username, function (Builder $query) {
        /** @var Illuminate\Contracts\Database\Query\Builder $query */
        $query->where('status', 'public')->latest();
      }, function (Builder $query) {
        /** @var Illuminate\Contracts\Database\Query\Builder $query */
        $query->latest();
      });
    }])->where('username', $param)->orWhere('id_user', $param)->first();

    if (!$user) {
      return $this->fail('dashboard', "User not found");
    }

    collect($user->files)->each(function ($f) use (&$imageFile) { #'&' buat ngerubah value dr variable original yg diuse di func ini,
      $i = 0;
      if (in_array(strtoupper($f->ekstensi_file), ['BMP', 'GIF', 'JPG', 'JPEG', 'PNG', 'TIFF', 'JFIF', 'AI', 'EPS', 'SVG', 'WEBP'])) {
        $imageFile[] = $i++;
      }
    });

    $user->files->each(function ($f) use (&$videoFile) {
      $i = 0;
      if (in_array(strtoupper($f->ekstensi_file), ['MP4', 'MOV', 'AVI', 'WMV', 'FLV', 'WebM'])) {
        $videoFile[] = $i++;
      }
    });

    $data['imageFile'] = count($imageFile);
    $data['videoFile'] = count($videoFile);
    $data['otherFile'] = $user->files->count() - $data['imageFile'] - $data['videoFile'];
    $data['user'] = $user;
    $data['jumlahPesan'] = $this->getJumlahPesan();
    $pesan = $this->getPesan();
    $data['pesan'] = $pesan;
    $data['title'] = $user->username . " ($user->fullname)";

    return view('user.detail', $data);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function account()
  {
    $data['title'] = 'Edit My Profile';

    $data['user'] = User::where('id_user', Auth::id())->where('username', Auth::user()->username)->first();
    $data['jumlahPesan'] = $this->getJumlahPesan();
    $pesan = $this->getPesan();
    $groupedPesan = $pesan->groupBy('id_pengirim');
    $data['pesan'] = $pesan;
    $data['pesanGrup'] = $groupedPesan->all();

    return view('user.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateUserRequest $request, User $user)
  {
    $idEdit = Auth::id();

    if ($user->id_user != $idEdit) {
      abort(404);
    }

    $validated = $request->validated();

    $validated = $request->safe()->only(['fullname', 'username', 'email', 'password', 'pp']);

    $checkIfUserProviededAvatar = session('isNewAvatar');
    $newAvatar = $validated['pp'] ?? null;
    $path = 'users/' . Auth::id();

    if (Storage::disk('public')->exists(Auth::user()->pp) && $checkIfUserProviededAvatar && !is_null($newAvatar)) {
      Storage::delete(Auth::user()->pp);
    }

    if (!is_null($newAvatar)) {
      $validPathPP = Storage::disk('public')->put($path, $newAvatar);
      $validated['pp'] = $validPathPP;
    }

    if (isset($validated['password'])) {
      $validated['password'] = Hash::make($request->input('password'));
    }

    $user->update($validated);

    session()->forget('isNewAvatar');

    return $this->flashMessage('info', ['account.settings'], "Profile updated successfully — <a href='/me' class='underline outline-none hover:text-gray-200 hover:no-underline focus:text-gray-200 focus:outline-2 focus:outline-offset-4 focus:outline-blue-500'>view your profile.</a>");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $user->files()->delete();
    Storage::deleteDirectory('users/' . $user->id_user);
    $user->delete();
    Auth::logout();
    Pesan::where('id_pengirim', $user->id_user)->delete();
    File::where('id_user', $user->id_user)->delete();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return to_route('login');
  }

  public function notification()
  {
    $data['user'] = User::where('id_user', Auth::id())->where('username', Auth::user()->username)->first();
    $data['jumlahPesan'] = $this->getJumlahPesan();
    $pesan = $this->getPesan();
    $groupedPesan = $pesan->groupBy('id_pengirim');
    $data['pesan'] = $pesan;
    $data['pesanGrup'] = $groupedPesan->all();

    return view('user.notification', $data);
  }

  public function ajax()
  {
    $query = request('q');
    $users = User::where('username', 'like', "%$query%")->where('username', '!=', Auth::user()->username)->take(5)->get();
    return response()->json([
      'dataUsers' => $users
    ]);
  }
}
