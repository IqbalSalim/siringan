<div x-cloak x-data="{ simpan: false, tambah: false, count: @entangle('count'), jenisBangunan: @entangle('jenisBangunan') }" x-on:close-simpan.window="simpan = false" x-on:open-simpan.window="simpan = true">
    <div class="bg-white shadow">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-row justify-between">
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{ __('Buat RAB') }}
                    </h2>
                    <div class="flex flex-row space-x-1 text-sm text-gray-400">
                        <div>Buat RAB</div>
                    </div>
                </div>
                <div class="self-end">
                    <button @click="tambah=true" type="button" class="hidden float-right text-sm md:flex btn-secondary"
                        wire:click.prevent="add({{ $i }})">Tambah</button>
                </div>
            </div>
        </div>
    </div>


    <div class="px-4 py-12 md:px-6 lg:px-8">
        <div class="px-4 py-3 bg-white rounded-lg shadow-lg">
            <div class="flex flex-row justify-between py-2 space-x-4">
                <div class="py-2">
                    <a href="buat-rab" x-show="tambah" class="text-sm btn-info">Refresh</a>
                </div>
                <div x-show="tambah" class="py-2 font-medium text-right">
                    <div class="self-end">
                        <button @click="tambah=true" type="button"
                            class="hidden float-right text-sm md:flex btn-secondary"
                            wire:click.prevent="add({{ $i }})">Tambah</button>
                    </div>
                </div>

            </div>
            <div class="divide-y-2 divide-gray-100 ">
                <div x-show="count < 1" class="text-lg font-medium text-center uppercase text-danger">
                    Data Kosong
                </div>
                <div x-show="count >= 1" class="flex flex-row justify-between">
                    <div class="py-2">
                        <x-label for="jenisBangunan" :value="__('Jenis Bangunan')" />

                        <select class="text-sm" wire:model="jenisBangunan">
                            <option>-- Pilih Jenis Bangunan --</option>
                            <option value='Rumah Tinggal'>Rumah Tinggal</option>
                            <option value='Perkantoran'>Perkantoran</option>
                            <option value='Lembaga Pendidikan'>Lembaga Pendidikan</option>
                            <option value='Hotel dan Restoran'>Hotel dan Restoran</option>
                            <option value='Rumah Sakit'>Rumah Sakit</option>
                            <option value='Pertokoan'>Pertokoan</option>
                            <option value='Rumah Ibadah'>Rumah Ibadah</option>
                        </select>
                        <span class="text-xs text-red-600">
                            @error('jenisBangunan')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="py-2" x-show="jenisBangunan == 'Rumah Tinggal'">
                        <x-label for="dayaRumah" :value="__('Daya Rumah')" />

                        <select class="text-sm" wire:model.defer="dayaRumah">
                            <option>-- Pilih Daya Rumah --</option>
                            <option value='MCB450'>Daya 450 W</option>
                            <option value='MCB900'>Daya 900 W</option>
                            <option value='MCB1300'>Daya 1300 W</option>
                            <option value='MCB2200'>Daya 2200 W</option>
                            <option value='MCB3500'>Daya 3500 W</option>
                            <option value='MCB5500'>Daya 5500 W</option>
                        </select>
                        <span class="text-xs text-red-600">
                            @error('dayaRumah')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="py-2">
                        <x-label for="namaBangunan" :value="__('Nama ' . $jenisBangunan)" />

                        <x-input wire:model.defer="namaBangunan" class="mt-1" type="text" name="namaBangunan" />
                        <span class="text-xs text-red-600">
                            @error('namaRumah')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <table class="block min-w-full divide-y divide-gray-200 table-fixed md:table">
                    <thead x-show="count >= 1" class="block bg-gray-50 md:table-header-group">
                        <tr
                            class="absolute block md:table-row -top-full md:top-auto -left-full md:left-auto md:relative">
                            <th scope="col"
                                class="block px-4 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell md:px-6">
                                #
                            </th>
                            <th scope="col"
                                class="block w-3/12 px-2 py-3 text-sm font-medium tracking-wider text-left text-gray-500 uppercase md:table-cell lg:px-6">
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
                                jml (Stop Kontak)
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
                                <tr class="flex flex-col py-2 space-y-2 md:py-0 md:space-y-0 md:flex-none md:table-row">
                            @endif

                            <td
                                class="flex flex-row items-center px-4 space-x-2 md:space-x-0 md:flex-none md:text-sm md:text-gray-500 md:py-4 md:table-cell lg:px-6 whitespace-nowrap">
                                <span class="w-1/3 font-bold md:hidden">#</span>
                                <span>{{ $value + 1 }}</span>
                            </td>
                            <td
                                class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:py-4 lg:px-6 md:flex-col">
                                <span class="w-1/3 font-bold md:hidden">Ruangan</span>
                                <select wire:change='changeEvent()' class="text-sm"
                                    wire:model.defer="posts.ruangan.{{ $value }}">
                                    <option>-- Pilih Ruangan --</option>
                                    @if ($jenisBangunan == 'Rumah Tinggal')
                                        <option value='{"ruangan":"Teras", "lux": "60"}'>Teras</option>
                                        <option value='{"ruangan":"Garasi", "lux": "60"}'>Garasi</option>
                                        <option value='{"ruangan":"Ruang Tamu", "lux": "120"}'>Ruang Tamu</option>
                                        <option value='{"ruangan":"Ruang Keluarga", "lux": "120"}'>Ruang Keluarga
                                        </option>
                                        <option value='{"ruangan":"Kamar", "lux": "120"}'>Kamar</option>
                                        <option value='{"ruangan":"Dapur", "lux": "250"}'>Dapur</option>
                                        <option value='{"ruangan":"Kamar Mandi", "lux": "250"}'>Kamar Mandi</option>
                                        <option value='{"ruangan":"Ruang Kerja", "lux": "250"}'>Ruang Santai/Kosong
                                        </option>
                                    @elseif ($jenisBangunan == 'Perkantoran')
                                        <option value='{"ruangan":"Ruang Direktur", "lux": "350"}'>Ruang Direktur
                                        </option>
                                        <option value='{"ruangan":"Ruang Kerja", "lux": "350"}'>Ruang Kerja</option>
                                        <option value='{"ruangan":"Ruang Komputer", "lux": "350"}'>Ruang Komputer
                                        </option>
                                        <option value='{"ruangan":"Ruang Rapat", "lux": "300"}'>Ruang Rapat</option>
                                        <option value='{"ruangan":"Ruang Gambar", "lux": "750"}'>Ruang Gambar
                                        </option>
                                        <option value='{"ruangan":"Gudang Arsip", "lux": "150"}'>Gudang Arsip
                                        </option>
                                        <option value='{"ruangan":"Ruang Arsip Aktif", "lux": "300"}'>Ruang Arsip
                                            Aktif
                                        </option>
                                    @elseif ($jenisBangunan == 'Lembaga Pendidikan')
                                        <option value='{"ruangan":"Ruang Kelas", "lux": "250"}'>Ruang Kelas</option>
                                        <option value='{"ruangan":"Perpustakaan", "lux": "300"}'>Perpustakaan
                                        </option>
                                        <option value='{"ruangan":"Laboratorium", "lux": "500"}'>Laboratorium
                                        </option>
                                        <option value='{"ruangan":"Ruang Gambar", "lux": "750"}'>Ruang Gambar
                                        </option>
                                        <option value='{"ruangan":"Kantin", "lux": "200"}'>Kantin</option>
                                    @elseif ($jenisBangunan == 'Hotel dan Restoran')
                                        <option value='{"ruangan":"Lobby , Koridor", "lux": "100"}'>Lobby , Koridor
                                        </option>
                                        <option value='{"ruangan":"Ballroom", "lux": "200"}'>Ballroom</option>
                                        <option value='{"ruangan":"Ruang Makan", "lux": "250"}'>Ruang Makan</option>
                                        <option value='{"ruangan":"Cafetaria", "lux": "250"}'>Cafetaria</option>
                                        <option value='{"ruangan":"Kamar Tidur", "lux": "150"}'>Kamar Tidur</option>
                                        <option value='{"ruangan":"Dapur", "lux": "300"}'>Dapur</option>
                                    @elseif ($jenisBangunan == 'Rumah Sakit')
                                        <option value='{"ruangan":"Ruang Rawat Inap", "lux": "250"}'>Ruang Rawat
                                            Inap
                                        </option>
                                        <option value='{"ruangan":"Ruang Operasi, Ruang Bersalin", "lux": "300"}'>
                                            Ruang
                                            Operasi, Ruang Bersalin
                                        </option>
                                        <option value='{"ruangan":"Laboratorium", "lux": "500"}'>Laboratorium
                                        </option>
                                        <option value='{"ruangan":"Ruang Rekreasi dan Rehabilitasi", "lux": "250"}'>
                                            Ruang Rekreasi dan Rehabilitasi</option>
                                    @elseif ($jenisBangunan == 'Pertokoan')
                                        <option value='{"ruangan":"Ruang Pamer Besar", "lux": "500"}'>Ruang Pamer
                                            Besar
                                        </option>
                                        <option value='{"ruangan":"Toko Kue dan Makanan", "lux": "250"}'>Toko Kue
                                            dan
                                            Makanan
                                        </option>
                                        <option value='{"ruangan":"Toko Buku", "lux": "300"}'>Toko Buku</option>
                                        <option value='{"ruangan":"Toko Perhiasan", "lux": "500"}'>Toko Perhiasan
                                        </option>
                                        <option value='{"ruangan":"Toko Sepatu", "lux": "500"}'>Toko Sepatu</option>
                                        <option value='{"ruangan":"Toko Pakaian", "lux": "500"}'>Toko Pakaian
                                        </option>
                                        <option value='{"ruangan":"Pasar Swalayan", "lux": "500"}'>Pasar Swalayan
                                        </option>
                                        <option value='{"ruangan":"Toko Alat Listrik", "lux": "250"}'>Toko Alat
                                            Listrik
                                        </option>
                                    @elseif ($jenisBangunan == 'Rumah Ibadah')
                                        <option value='{"ruangan":"Masjid", "lux": "200"}'>Masjid</option>
                                        <option value='{"ruangan":"Gereja", "lux": "200"}'>Gereja</option>
                                    @endif
                                </select>
                                @error('posts.ruangan.' . $value)
                                    <span class="block text-sm text-danger">{{ $message }}</span>
                                @enderror

                            </td>
                            <td class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                <span class="w-1/3 font-bold md:hidden">Panjang</span>
                                <input type="number" class="text-sm" min="0"
                                    wire:model.defer="posts.panjang.{{ $value }}">
                                @error('posts.panjang.' . $value)
                                    <span class="block text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                <span class="w-1/3 font-bold md:hidden">Lebar</span>
                                <input type="number" class="text-sm" min="0"
                                    wire:model.defer="posts.lebar.{{ $value }}">
                                @error('posts.lebar.' . $value)
                                    <span class="block text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                <span class="w-1/3 font-bold md:hidden">Tinggi</span>
                                <input type="number" class="text-sm" min="0"
                                    wire:model.defer="posts.tinggi.{{ $value }}">
                                @error('posts.tinggi.' . $value)
                                    <span class="block text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </td>

                            @if ($posts !== null && isset($posts['ruangan'][$value]))
                                @if (json_decode($posts['ruangan'][$value])->ruangan !== 'Kamar Mandi' && json_decode($posts['ruangan'][$value])->ruangan !== 'Teras')
                                    <td
                                        class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                        <span class="w-1/3 font-bold md:hidden">Jml Stop Kontak</span>
                                        <input type="number" class="text-sm" min="0"
                                            wire:model.defer="posts.jmlsk.{{ $value }}">
                                        @error('posts.jmlsk.' . $value)
                                            <span class="block text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @else
                                <td></td>
                            @endif

                            <td class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6">
                                <input type="checkbox" class="text-sm" wire:change="cheklist({{ $value }})"
                                    wire:model="posts.cheklist.{{ $value }}">
                            </td>
                            <td class="flex flex-row items-center px-2 space-x-2 md:space-x-0 md:table-cell lg:px-6 ">
                                <span class="w-16 font-bold md:hidden">Action</span>
                                <button type=" button" class="text-sm btn-danger"
                                    wire:click.prevent="remove({{ $key }}, {{ $value }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg></button>
                            </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>

            </div>
            <div class="flex flex-row justify-end px-4 py-2 space-x-4 md:space-x-0">
                {{-- <button type="submit" class="text-sm btn-primary">Simpan</button> --}}

                <button x-show="simpan" wire:click.prevent='confirm' type="submit"
                    class="text-sm btn-primary">Simpan</button>

                <button type="button" class="text-sm text-left md:hidden btn-secondary"
                    wire:click.prevent="add({{ $i }})">Tambah
                    Ruangan</button>
            </div>

        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
