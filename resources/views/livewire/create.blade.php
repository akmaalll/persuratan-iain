<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ $post_id ? 'Edit Post' : 'Buat Post' }}
                        </h3>
                        <div class="mt-2">
                            <input type="text" wire:model="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Judul">
                            @error('judul') <span class="text-red-500">{{ $message }}</span>@enderror <br><br>
                            <textarea wire:model="isi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Isi"></textarea>
                            @error('idi') <span class="text-red-500">{{ $message }}</span>@enderror <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click="store()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
                <button wire:click="closeModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
