<div x-cloak x-data="{simpan:false}" x-on:close-simpan.window="simpan = false" x-on:open-simpan.window="simpan = true">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Buat RAB') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div>Buat RAB</div>
        </div>
    </x-slot>


    <div class="px-4 py-12 md:px-6 lg:px-8">
        <div class="px-4 py-3 bg-white rounded-lg shadow-lg">
            <form wire:submit.prevent='confirm' novalidate>
                <div class="py-2 font-medium">
                    Form RAB
                </div>
                <div class="flex flex-row items-end justify-between py-2 space-x-4">
                    {{-- <div class="flex flex-col items-start flex-1 space-y-2 md:items-center md:flex-row md:space-x-4">
                        <label class="text-sm font-medium">Jenis Bangunan</label>
                        <select class="text-sm capitalize md:w-2/12 text-default">
                            <option value="rumah">rumah</option>
                            <option value="gedung">gedung</option>
                        </select>
                    </div> --}}
                    <div class="py-2">
                        <a href="buat-rab" class="text-sm btn-info">Refresh</a>
                    </div>
                    <button type="button" class="hidden text-sm text-left md:flex btn-secondary"
                        wire:click.defer="add({{ $i }})">Tambah</button>
                </div>
                <div class="divide-y-2 divide-gray-100 ">
                    <table x-cloak x-data="{count : @entangle('count')}"
                        class="block min-w-full divide-y divide-gray-200 table-fixed md:table">
                        <thead x-show="count >= 1" class="block bg-gray-50 md:table-header-group">
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
                                    class="block px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell lg:px-6">
                                    <span class="sr-only">Chekbox</span>
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
                                    class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                    <input type="checkbox" class="text-sm"
                                        wire:change="cheklist({{ $value }})"
                                        wire:model="posts.cheklist.{{ $value }}">
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
                <div class="flex flex-row justify-end px-4 py-2 space-x-4 md:space-x-0">
                    {{-- <button type="submit" class="text-sm btn-primary">Simpan</button> --}}

                    <button x-show="simpan" type="submit" class="text-sm btn-primary">Simpan</button>

                    <button type="button" class="text-sm text-left md:hidden btn-secondary"
                        wire:click.prevent="add({{ $i }})">Tambah
                        Ruangan</button>
                </div>
            </form>
        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
