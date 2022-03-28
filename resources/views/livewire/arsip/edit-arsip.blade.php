<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit RAB') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div><a href="{{ route('arsip-rab') }}">Arsip RAB</a></div>
            <div>-</div>
            <div>Edit RAB</div>
        </div>
    </x-slot>
    <form wire:submit.prevent='update' novalidate>
        <div class="px-4 py-12 md:px-6 lg:px-8">
            <div class="px-4 py-3 bg-white divide-y-2 divide-gray-200 rounded-lg shadow-lg">
                <div class="flex flex-row justify-between py-2">
                    <h1 class="font-medium text-default">Form RAB</h1>
                    <a href="{{ route('edit-rab', $idRab) }}" class="text-sm btn-info">Refresh</a>
                </div>
                <div x-show="count >= 1" class="py-2">
                    <x-label for="namaRumah" :value="__('Nama Rumah')" />

                    <x-input wire:model.defer="namaRumah" class="block w-full mt-1" type="text" name="namaRumah" />
                    <span class="text-xs text-red-600">
                        @error('namaRumah')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="divide-y-2 divide-gray-100 ">

                    <table class="block min-w-full divide-y divide-gray-200 table-fixed md:table">
                        <thead class="block bg-gray-50 md:table-header-group">
                            <tr
                                class="absolute block md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                                <th scope="col"
                                    class="block px-4 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell md:px-6">
                                    #
                                </th>
                                <th scope="col"
                                    class="block px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell w-max lg:px-6">
                                    ruangan
                                </th>
                                <th scope="col"
                                    class="block px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell lg:px-6">
                                    panjang (m)
                                </th>
                                <th scope="col"
                                    class="block px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell lg:px-6">
                                    lebar (m)
                                </th>
                                <th scope="col"
                                    class="block px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell lg:px-6">
                                    tinggi (m)
                                </th>
                                <th scope="col"
                                    class="px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase lg:px-6">
                                    <span class="sr-only">Edit</span>
                                    <span class="sr-only">Hapus</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="block bg-white divide-y divide-gray-200 md:table-row-group">
                            @foreach ($inputs as $key => $value)
                                @if ($value % 2 !== 0)
                                    <tr
                                        class="flex flex-col py-2 space-y-2 bg-gray-100 md:py-0 md:space-y-0 md:flex-none md:table-row">
                                    @else
                                    <tr
                                        class="flex flex-col py-2 space-y-2 md:py-0 md:space-y-0 md:flex-none md:table-row">
                                @endif

                                <td
                                    class="flex flex-row items-center px-4 space-x-2 md:space-x-0 md:flex-none md:text-sm md:text-gray-500 md:py-4 md:table-cell lg:px-6 whitespace-nowrap">
                                    <span class="w-1/3 font-bold md:hidden">#</span>
                                    <span>{{ $value + 1 }}</span>
                                </td>
                                <td
                                    class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:py-4 lg:px-6 md:flex-col">
                                    <span class="w-1/3 font-bold md:hidden">Ruangan</span>
                                    <select class="text-sm" wire:model.defer="posts.ruangan.{{ $value }}">
                                        <option>-- Pilih Ruangan --</option>
                                        <option value='{"ruangan":"Teras", "lux": "60"}'>Teras</option>
                                        <option value='{"ruangan":"Garasi", "lux": "60"}'>Garasi</option>
                                        <option value='{"ruangan":"Ruang Tamu", "lux": "250"}'>Ruang Tamu</option>
                                        <option value='{"ruangan":"Ruang Keluarga", "lux": "250"}'>Ruang Keluarga
                                        </option>
                                        <option value='{"ruangan":"Kamar", "lux": "250"}'>Kamar</option>
                                        <option value='{"ruangan":"Dapur", "lux": "250"}'>Dapur</option>
                                        <option value='{"ruangan":"Kamar Mandi", "lux": "250"}'>Kamar Mandi</option>
                                        <option value='{"ruangan":"Ruang Kerja", "lux": "250"}'>Ruang Santai/Kosong
                                        </option>
                                    </select>
                                    @error('posts.ruangan.' . $value)
                                        <span class="block text-sm text-danger">{{ $message }}</span>
                                    @enderror

                                </td>
                                <td
                                    class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                    <span class="w-1/3 font-bold md:hidden">Panjang</span>
                                    <input type="number" class="text-sm" min="0"
                                        wire:model.defer="posts.panjang.{{ $value }}">
                                    @error('posts.panjang.' . $value)
                                        <span class="block text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td
                                    class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                    <span class="w-1/3 font-bold md:hidden">Lebar</span>
                                    <input type="number" class="text-sm" min="0"
                                        wire:model.defer="posts.lebar.{{ $value }}">
                                    @error('posts.lebar.' . $value)
                                        <span class="block text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td
                                    class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                    <span class="w-1/3 font-bold md:hidden">Tinggi</span>
                                    <input type="number" class="text-sm" min="0"
                                        wire:model.defer="posts.tinggi.{{ $value }}">
                                    @error('posts.tinggi.' . $value)
                                        <span class="block text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td
                                    class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6 ">
                                    <span class="w-16 font-bold md:hidden">Action</span>
                                    <button type=" button" class="text-sm btn-danger"
                                        wire:click.prevent="remove({{ $key }}, {{ $value }})">Hapus</button>
                                </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>

                </div>
                <div class="flex flex-row justify-center px-4 py-2 space-x-4 md:justify-between">
                    <div class="flex flex-row space-x-3">
                        <button type="submit" class="text-sm btn-primary">Simpan</button>
                        <a href="{{ route('arsip-rab') }}" type="submit" class="text-sm btn-warning">Batal</a>
                    </div>
                    <button type="button" class="text-sm text-left btn-secondary"
                        wire:click.prevent="add({{ $i }})">Tambah
                        Ruangan</button>
                </div>
            </div>
        </div>
    </form>
</div>
