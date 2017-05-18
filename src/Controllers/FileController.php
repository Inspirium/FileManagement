<?php

namespace Inspirium\FileManagement\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inspirium\FileManagement\Models\File;

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
        $path = public_path() . '/uploads/'; //TODO: specific folders
        $file->move($path, $file->getClientOriginalName() );
        $f = File::create([
            'title' => $request->get('title'),
            'location' => $path,
            'type' => $file->getClientMimeType(),
            'owner_id' => \Auth::id()
        ]);
        return response()->json(['result' => 'success', 'message' => 'File succesfully uploaded', 'data' => $f]);
    }

    public function updateFile(Request $request, $id) {
        $file = File::findOrFail($id);
        $file->title = $request->get('title');
    }
}
