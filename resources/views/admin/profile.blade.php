@extends('admin.layouts.app')

@section('page-title', 'Profil & Keamanan')
@section('page-subtitle', 'Kelola akun dan ganti password')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-4xl">

    {{-- Update Profile Info --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-1">Informasi Akun</h3>
        <p class="text-slate-400 text-xs mb-5">Ubah nama dan email admin</p>

        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf @method('PUT')

            @if(session('success') && !session('password_changed'))
            <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm">
                ✓ {{ session('success') }}
            </div>
            @endif

            @if($errors->has('name') || $errors->has('email'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                {{ $errors->first('name') ?: $errors->first('email') }}
            </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50">
                </div>
            </div>
            <button type="submit" class="mt-5 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-xl transition text-sm">
                💾 Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <h3 class="font-bold text-slate-800 mb-1">Ganti Password</h3>
        <p class="text-slate-400 text-xs mb-5">Disarankan menggunakan minimal 8 karakter</p>

        <form method="POST" action="{{ route('admin.profile.password') }}">
            @csrf @method('PUT')

            @if(session('success') && session('password_changed'))
            <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm">
                ✓ {{ session('success') }}
            </div>
            @endif

            @if($errors->has('current_password') || $errors->has('password'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                {{ $errors->first('current_password') ?: $errors->first('password') }}
            </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Password Lama</label>
                    <input type="password" name="current_password" required
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50"
                           placeholder="••••••••">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Password Baru</label>
                    <input type="password" name="password" required
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50"
                           placeholder="Min. 6 karakter">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-slate-50"
                           placeholder="Ulangi password baru">
                </div>
            </div>
            <button type="submit" class="mt-5 w-full bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2.5 rounded-xl transition text-sm">
                🔒 Ganti Password
            </button>
        </form>
    </div>

</div>
@endsection
