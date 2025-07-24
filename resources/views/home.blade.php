<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>مرحبا بك - صارحني</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="navbar">
        <div class="user-info">{{ Auth::user()->name }}</div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">📕 تسجيل الخروج</button>
        </form>
    </div>

    <div class="container">
        <h2>مرحبًا <strong>{{ Auth::user()->name }}</strong></h2>


        <form action="{{ route('home') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="ابحث عن مستخدم بالاسم أو الإيميل" value="{{ request('search') }}">
            <button type="submit">🔍 بحث</button>
        </form>

        @if($searchResult)

            <div class="user-card">
                <p class="username">{{ $searchResult->name }}</p>
                <form action="{{ route('messages.send', $searchResult->id) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="3" placeholder="اكتب رسالتك هنا..." required></textarea>
                    <button type="submit" class="send-btn">✉️ إرسال رسالة</button>
                </form>
            </div>
        @elseif(request('search'))
            <p class="no-result">❌ لا يوجد مستخدم بهذا الاسم أو البريد الإلكتروني.</p>
        @endif


        <h3>📥 الرسائل المستلمة:</h3>
        @forelse($messages as $msg)
            <div class="message-card">
                <p>{{ $msg->content }}</p>
                <span class="time">{{ $msg->created_at->diffForHumans() }}</span>
            </div>
        @empty
            <p class="no-messages">لا توجد رسائل بعد.</p>
        @endforelse
    </div>
</body>
</html>
