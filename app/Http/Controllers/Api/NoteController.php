<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        if ($notes->isEmpty()) {
            $data = [
                'message' => 'No hay notas disponibles',
                'status' => 200
            ];
            return response()->json($data, 404);
        }
        
        return response()->json($notes, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $note = Note::create(
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]
        ); 
        if (!$note) {
            $data = [
                'message' => 'Error al crear la nota',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'message' => 'Nota creada con éxito',
            'note' => $note,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
    public function show($id)
    {
        $note = Note::find($id);
        if (!$note) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'note' => $note,
            'status' => 200
        ];
        return response()->json($note, 200);
    }
    public function destroy($id)
    {
        $note = Note::find($id);
        if (!$note) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $note->delete();
        $data = [
            'message' => 'Nota eliminada con éxito',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function update(Request $request, $id)
    {
        $note = Note::find($id);
        if (!$note) {
            $data = [
                'message' => 'Nota no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        $data = [
            'message' => 'Nota actualizada con éxito',
            'note' => $note,
            'status' => 200
        ];

        return response()->json($data, 200);   
    }
}
