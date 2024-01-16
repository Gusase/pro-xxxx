<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
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

		// $files = File::with('user')->latest()->where('status', 'public');



		// $data['files'] = $files->get();
		$data['title'] = 'Discover';
		$files = DB::table('users')
			->join('files', 'users.id_user', '=', 'files.id_user')
			->select('users.*', 'files.*');

		if (request('search')) {
			$files->where('judul_file', 'like', '%' . request('search') . '%')->orWhere('original_filename', 'like', '%' . request('search') . '%');
		}

		$data['files'] = $files->get();

		return view('user.file.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['jumlahPesan'] = $this->getJumlahPesan();
		$pesan = $this->getPesan();
		$groupedPesan = $pesan->groupBy('id_pengirim');
		$data['pesan'] = $pesan;
		$data['pesanGrup'] = $groupedPesan->all();
		$data['return'] = request('return') ?? '/';

		return view('user.file.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreFileRequest $request)
	{
		$errors = [
			'judul_file.required' => 'Title must be filled in',
			'judul_file.unique' => 'Title has already been used',
			'judul_file.max' => 'Max 255 characters',
			'files.required' => 'Files must be filled in',
			'files.file' => 'Files format must be a file',
			'status.required' => 'Status must be filled in',
		];

		$rules = [
			'files' => 'required|file',
			'status' => 'required',
		];

		if (File::where('judul_file', $request->input('judul_file'))->where('id_user', auth()->id())->count() == 0) {
			$rules['judul_file'] = 'required';
			$validatedData = $request->validate($rules, $errors);
		} else {
			$rules['judul_file'] = 'required|unique:files|max:255';
			$validatedData = $request->validate($rules, $errors);
		}

		// Ambil file
		$file = $request->file('files');
		// Nama file asli
		$originalNameFile = $file->getClientOriginalName();
		// Ekstensi file
		$ekstensi = $file->getClientOriginalExtension();
		// Size file
		if ($file->getSize() < 1024 * 1024) {
			$size = round($file->getSize() / 1024, 1) . ' kb';
		} else {
			$size = round($file->getSize() / (1024 * 1024), 2) . ' mb';
		}
		// Mime type file
		$mime = $file->getMimeType();
		// Generate nama sampul baru
		// Pindahkan file ke folder asli
		$path = 'users/' . Auth::user()->id_user . '/files';
		$namaFileRandom = $file->store($path);
		$return = request('return');

		$validatedData = [
			'id_user' => Auth::user()->id_user,
			'judul_file' => $request->input('judul_file'),
			'original_filename' => $originalNameFile,
			'generate_filename' => $namaFileRandom,
			'status' => $request->input('status'),
			'ekstensi_file' => $ekstensi,
			'mime_type' => $mime,
			'file_size' => $size,
			'deskripsi' => $request->input('deskripsi')
		];

		File::create($validatedData);

		// if ($return != null) {
		//     return $this->redirectTo('dashboard', $return, "Successfully uploaded file");
		// }

		return $this->success('dashboard', "Successfully uploaded file");
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateFileRequest $request, File $file)
	{
		$errors = [
			'judul_file.required' => 'Title must be filled in',
			'judul_file.unique' => 'Title has already been used',
			'files.required' => 'Files must be filled in',
			'files.file' => 'Files format must be a file',
			'status.required' => 'Status must be filled in',
			'deskripsi.required' => 'Description must be filled in'
		];
		$rules = [
			'files' => 'file',
			'status' => 'required',
		];
		if ($file->judul_file == $request->input('judul_file')) {
			$rules['judul_file'] = 'required';
			$validatedData = $request->validate($rules, $errors);
		} else {
			$rules['judul_file'] = 'required|unique:files|max:255';
			$validatedData = $request->validate($rules, $errors);
		}

		if ($request->file('files')) {
			// Ambil file
			$fileInput = $request->file('files');
			// Nama file asli
			$originalNameFile = $fileInput->getClientOriginalName();
			// Ekstensi file
			$ekstensi = $fileInput->getClientOriginalExtension();
			// Size file
			if ($fileInput->getSize() < 1024 * 1024) {
				$size = round($fileInput->getSize() / 1024, 1) . ' kb';
			} else {
				$size = round($fileInput->getSize() / (1024 * 1024), 2) . ' mb';
			}
			// Mime type file
			$mime = $fileInput->getMimeType();
			// Generate nama sampul baru
			// Pindahkan file ke folder asli
			$path = 'users/' . Auth::user()->id_user . '/files';
			$namaFileRandom = $fileInput->store($path);
			Storage::delete($file->generate_filename);
		} else {
			$originalNameFile = $file->original_filename;
			$ekstensi = $file->ekstensi_file;
			$mime = $file->mime_type;
			$size = $file->file_size;
			$namaFileRandom = $file->generate_filename;
		}

		$validatedData = [
			'id_user' => Auth::user()->id_user,
			'judul_file' => $request->input('judul_file'),
			'original_filename' => $originalNameFile,
			'generate_filename' => $namaFileRandom,
			'status' => $request->input('status'),
			'ekstensi_file' => $ekstensi,
			'mime_type' => $mime,
			'file_size' => $size,
			'deskripsi' => $request->input('deskripsi')
		];

		$file->update($validatedData);

		return $this->success('dashboard', "Successfully edited file");
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(File $file)
	{
		$data = ['file' => $file];

		if (is_null($file)) {
			session()->flash('errors', 'File not found');
			return redirect('/');
		}

		$data['jumlahPesan'] = $this->getJumlahPesan();
		$pesan = $this->getPesan();
		$groupedPesan = $pesan->groupBy('id_pengirim');
		$data['pesan'] = $pesan;
		$data['pesanGrup'] = $groupedPesan->all();

		if ($file->id_user != Auth::id()) abort(404);
		return view('user.file.edit', $data);
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(File $file)
	{
		Storage::delete($file->generate_filename);
		$file->destroy($file->id_file);

		session()->flash('success', 'Successfully deleted file!');
		return redirect()->back();
	}

	/**
	 * Download spesific file to internal storage user
	 */
	public function download($id_file)
	{
		$file = File::where('id_file', $id_file)->first();
		if ($file == null) {
			return $this->fail('dashboard', "File not found");
		}
		$path = public_path('storage/' . $file->generate_filename);
		$headers = [
			'Content-Type' => 'application/octet-stream'
		];

		$this->success('dashboard', "File successfully downloaded");
		return response()->download($path, $file->original_filename, $headers);
	}

	public function downloadByLink($id_file, $filename)
	{
		$filePathDB = 'users/' . $id_file . '/files/' . $filename;
		$fileDB = File::where('generate_filename', $filePathDB)->first();

		if ($fileDB == null) {
			return $this->fail('dashboard', "File not found");
		}

		session()->flash('download', $fileDB->id_file);
		return $this->success('dashboard', "File successfully downloaded");
	}

	public function downloadByLinkPublik($id_file, $filename)
	{
		$filePathDB = 'users/' . $id_file . '/files/' . $filename;
		$fileDB = File::where('generate_filename', $filePathDB)->first();

		if ($fileDB == null) {
			return $this->fail('dashboard', "File not found");
		}

		session()->flash('download', $fileDB->id_file);
		return $this->success('dashboardPublik', "File successfully downloaded");
	}

	public function fileDetail($username, $id_file)
	{
		$data['jumlahPesan'] = $this->getJumlahPesan();
		$pesan = $this->getPesan();
		$groupedPesan = $pesan->groupBy('id_pengirim');
		$data['pesan'] = $pesan;
		$data['pesanGrup'] = $groupedPesan->all();
		$data['user'] = User::where('username', $username)->first();

		$data['file'] = File::with('user:id_user,fullname,username,pp')->where('id_file', $id_file)->where('id_file', $id_file)->where(
			'id_user',
			'=',
			fn (\Illuminate\Database\Query\Builder $query) =>
			$query->select('id_user')->from('users')->where('username', $username)->get()
		)->first(['original_filename', 'generate_filename', 'judul_file', 'status', 'mime_type', 'id_file', 'file_size', 'deskripsi', 'created_at', 'id_user', 'ekstensi_file']);


		// kalau file ga ada atau statusnya private
		if (!$data['file']) {
			return $this->fail('dashboard', "File $username ($id_file) not found");
		}

		if ($data['file']->id_user != Auth::id() && $data['file']->status != 'public') {
			return $this->fail('dashboard', "File $username ($id_file) not found");
		}
		return view('user.file.detalPublik', $data);
	}

	public function downloadRedirect($id_file, $username)
	{
		$file = File::where('id_file', $id_file)->first();

		if ($file == null) {
			return $this->fail('dashboard', "File not found");
		}

		return redirect()->route('file.share.detail', ['username' => $username, 'id_file' => $file->id_file])
			->with('download', $file->id_file)
			->with('username', $username);
	}

	public function fileShareDetail($username, $id_file)
	{
		$data['jumlahPesan'] = $this->getJumlahPesan();
		$pesan = $this->getPesan();
		$groupedPesan = $pesan->groupBy('id_pengirim');
		$data['pesan'] = $pesan;
		$data['pesanGrup'] = $groupedPesan->all();
		$data['user'] = User::where('username', $username)->first();

		$shareFile = DB::table('files AS f')
			->join('users AS u', 'u.id_user', '=', 'f.id_user')
			->join('pesans AS p', 'f.id_file', '=', 'p.id_file')
			->where('p.id_file', '=', $id_file)
			->where('p.id_penerima', '=', $this->getUserId())
			->where('p.id_pengirim', '=', fn (\Illuminate\Database\Query\Builder $query) =>
			$query->select('id_user')->from('users')->where('username', $username)->get())
			->first(['p.pesan', 'f.original_filename', 'f.generate_filename', 'f.judul_file', 'f.status', 'f.mime_type', 'f.ekstensi_file', 'f.id_file', 'u.fullname', 'u.pp', 'f.file_size', 'f.deskripsi', 'f.created_at']);

		if (!$shareFile) {
			return $this->fail('dashboard', "File not found");
		}

		$data['file'] = $shareFile;
		$data['title'] = 'File dari ' . $data['file']->fullname;
		return view('user.file.detalPublik', $data);
	}
}
