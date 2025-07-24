<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Massage;
use App\Models\User;

class MessageController extends Controller
{
    // عرض صفحة إرسال الرسالة
    public function show(User $user)
    {
        return view('messages.send', compact('user'));
    }

    // إرسال الرسالة
    public function send(Request $request, $userId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        // تأكد أن المستخدم موجود
        $recipient = User::where('id', $userId)->firstOrFail();

        // إنشاء الرسالة
        Massage::create([
            'from_user_id' => Auth::id(),
            'to_user_id'   => $recipient->getKey(),
            'content'      => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح.');
    }
}
