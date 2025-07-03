<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function excel(Request $request)
    {
        $query = Todo::query();
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        if ($request->filter === 'completed') {
            $query->where('is_completed', true);
        } elseif ($request->filter === 'pending') {
            $query->where('is_completed', false);
        }
        $todos = $query->orderByDesc('created_at')->get();

        $filename = 'todos_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        $callback = function() use ($todos) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Judul', 'Status', 'Dibuat', 'Diupdate']);
            foreach ($todos as $todo) {
                fputcsv($handle, [
                    $todo->id,
                    $todo->title,
                    $todo->is_completed ? 'Selesai' : 'Belum',
                    $todo->created_at,
                    $todo->updated_at,
                ]);
            }
            fclose($handle);
        };
        return Response::stream($callback, 200, $headers);
    }
}
