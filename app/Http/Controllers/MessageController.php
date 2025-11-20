<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $allowed = ['created_at', 'body', 'user'];

        $sort = $request->query('sort', 'created_at');
        $dir = $request->query('dir', 'desc') === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, $allowed)) {
            $sort = 'created_at';
        }

        // per-page (allow user to request any reasonable number)
        $per = (int) $request->query('per', 25);
        if ($per <= 0) {
            $per = 25;
        }
        // cap to avoid excessive queries
        $per = min($per, 200);

        if ($sort === 'user') {
            // Order by the related user's name using a subquery
            $messages = Message::with('user')
                ->orderByRaw("(select name from users where users.id = messages.user_id) {$dir}")
                ->orderByDesc('created_at')
                ->paginate($per)
                ->withQueryString();
        } else {
            $messages = Message::with('user')
                ->orderBy($sort, $dir)
                ->paginate($per)
                ->withQueryString();
        }

        return view('messages', compact('messages', 'sort', 'dir'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'body' => $data['body'],
        ]);

        $request->session()->flash('status', __('Üzenet sikeresen elküldve.'));

        return redirect()->route('home');
    }
}
