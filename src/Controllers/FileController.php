<?php

namespace Inspirium\FileManagement\Controllers;

use Inspirium\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inspirium\FileManagement\Models\File;
use Inspirium\HumanResources\Models\Employee;

class FileController extends Controller {

    public function getFileInfo($id = null) {
        $file = File::firstOrFail($id);
        return response()->json($file);
    }

    public function postFile(Request $request) {
        if(!$request->hasFile('file')) {
            return response()->json(['result' => 'error', 'message' => 'Upload file not found'], 400);
        }
        $file = $request->file('file');
        if(!$file->isValid()) {
            return response()->json([ 'result' => 'error', 'message' => 'Invalid file upload'], 400);
        }
        $disk = $request->input('disk');
        if (!$disk) {
        	$disk = 'public';
        }
        $dir = $request->input('dir');
        if (!$dir) {
        	$dir = 'public';
        }
	    $path = $file->store(sprintf('%s/%d/%d', $dir, date('Y'), date('m') ), $disk);
       // $file->move($path, $file->getClientOriginalName() );
        $owner = Employee::where('user_id', \Auth::id())->first();
        $f = File::create([
            'title' => $request->get('title'),
            'location' => $path,
            'link' => Storage::disk($disk)->url($path),
            'type' => $file->getClientMimeType(),
        ]);
        $f->owner()->associate($owner);
        $f->save();
        return response()->json(['result' => 'success', 'message' => 'File succesfully uploaded', 'data' => $f]);
    }

    public function updateFile(Request $request, $id) {
        $file = File::findOrFail($id);
        $file->title = $request->get('title');
    }

    public function deleteFile($id) {
    	File::destroy($id);
    	return response()->json(['message' => 'success']);
    }
}
