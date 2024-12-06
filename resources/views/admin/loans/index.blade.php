@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 border-b-4 border-red-500 pb-2 mb-6">Daftar Peminjaman</h2>
    
    <a href="{{ route('admin.loans.create') }}" class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600 transition duration-300 mb-4">Tambah Peminjaman</a>

    <div class="bg-white shadow-lg rounded-lg mt-6 overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-red-500 text-white">
                <tr>
                    <th class="p-4 text-left">Buku</th>
                    <th class="p-4 text-left">Peminjam</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Denda</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($loans as $loan)
                <tr>
                    <td class="p-4 text-gray-700">{{ $loan->book->title }}</td>
                    <td class="p-4 text-gray-700">{{ $loan->user->name }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-white {{ $loan->status == 'returned' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-700">
                        Rp {{ $loan->fines?->amount ? number_format($loan->fines->amount, 0, ',', '.') : '-' }}
                    </td>
                    <td class="p-4 flex gap-2 items-center">
                        <!-- Tampilkan Denda jika Ada -->
                        @if ($loan->fines)
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full">Denda: Rp {{ number_format($loan->fines->amount, 0, ',', '.') }}</span>
                        @endif

                        <!-- Tombol Kembalikan -->
                        @if ($loan->status !== 'returned')
                        <form action="{{ route('admin.loans.return', $loan->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition duration-200">Kembalikan</button>
                        </form>
                        @endif

                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.loans.edit', $loan->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Edit</a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4 px-4 py-2">
            {{ $loans->links() }}
        </div>
    </div>
</section>
@endsection
