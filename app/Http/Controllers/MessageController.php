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

    public function index()
    {
        $messages = Message::with('user')->orderByDesc('created_at')->paginate(25);
        return view('messages', compact('messages'));
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
