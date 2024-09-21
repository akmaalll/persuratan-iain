<div class="container mx-auto">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 my-3 rounded">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
        Buat Data Baru
    </button>

    @if ($isOpen)
        @include('livewire.create')
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Judul</th>
                <th class="px-4 py-2">Isi</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td class="border px-4 py-2">{{ $post->judul }}</td>
                    <td class="border px-4 py-2">{{ $post->isi }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $post->id }})"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-4 rounded">Edit</button>
                        <button wire:click="delete({{ $post->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
