<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Bahan') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div class="hover:text-primary"><a href="{{ route('barang') }}">Barang</a></div>
            <div>-</div>
            <div>Tambah Barang</div>
        </div>
    </x-slot>

    <div class="px-4 py-12 md:px-6 lg:px-8">
        <div class="px-4 py-4 bg-white rounded-lg shadow-lg">
            <form wire:submit.prevent='store' novalidate>
                @csrf
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Form Bahan
                    </h3>

                    <div class="mt-2">
                        <p class="text-sm leading-5 text-primary">
                            silahkan isi data bahan
                        </p>
                    </div>
                </div>

                <div class="flex flex-col flex-1 px-4 py-2">
                    <!-- Kategori -->
                    <div>
                        <x-label for="kategori" :value="__('Kategori')" />
                        <select class="text-sm" wire:change='changeEvent($event.target.value)'>
                            <option>-- Pilih Kategori Bahan --</option>
                            <option value="Lampu">Lampu</option>
                            <option value="Kabel">Kabel</option>
                            <option value="PIP">Pipa</option>
                            <option value="Saklar">Saklar</option>
                            <option value="PET">Peteng</option>
                            <option value="StopKontak">Stop Kontak</option>
                            <option value="MCB">MCB</option>
                        </select>
                        <span class="text-sm text-danger">
                            @error('kategori')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <!-- Nama -->
                    <div class="mt-4">
                        <x-label for="nama" :value="__('Nama')" />

                        <x-input wire:model.defer="nama" id="nama" class="block w-full mt-1" type="text" name="nama"
                            autofocus />
                        <span class="text-sm text-danger">
                            @error('nama')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <!-- Watt -->
                    @if ($kategori == 'Lampu')
                        <div class="mt-4">
                            <x-label for="watt" :value="__('Watt')" />

                            <x-input wire:model.defer="watt" id="watt" class="block w-full mt-1" type="text" name="watt"
                                autofocus />
                            <span class="text-sm text-danger">
                                @error('watt')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    @endif

                    @if ($kategori == 'Kabel' || $kategori == 'StopKontak' || $kategori == 'MCB')
                        <!-- Jenis -->
                        <div class="mt-4">
                            <x-label for="jenis" :value="__('Jenis')" />
                            <select class="text-sm" wire:model.defer='jenis'>
                                <option>-- Pilih Jenis --</option>
                                @if ($kategori == 'Kabel')
                                    <option value="NYMB">NYM Tegangan Besar</option>
                                    <option value="NYMK">NYM Tegangan Kecil</option>
                                    <option value="NYA">NYA</option>
                                @elseif ($kategori == 'MCB')
                                    <option value="MCB450">Daya 450 Watt</option>
                                    <option value="MCB900">Daya 900 Watt</option>
                                    <option value="MCB1300">Daya 1300 Watt</option>
                                    <option value="MCB2200">Daya 2200 Watt</option>
                                    <option value="MCB3500">Daya 3500 Watt</option>
                                    <option value="MCB5500">Daya 5500 Watt</option>
                                @else
                                    <option value="SKB">Stop Kontak Biasa</option>
                                    <option value="SKK">Stop Kontak Khusus</option>
                                @endif

                            </select>
                            <span class="text-sm text-danger">
                                @error('jenis')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    @endif



                    <!-- Satuan -->
                    <div class="mt-4">
                        <x-label for="satuan" :value="__('Satuan')" />

                        <x-input wire:model.defer="satuan" id="satuan" class="block w-full mt-1" type="text"
                            name="satuan" autofocus />
                        <span class="text-sm text-danger">
                            @error('satuan')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <!-- Harga -->
                    <div class="mt-4">
                        <x-label for="harga" :value="__('Harga')" />

                        <x-input wire:model.defer="harga" id="harga" class="block w-full mt-1" type="number"
                            name="harga" autofocus />
                        <span class="text-sm text-danger">
                            @error('harga')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    @if ($kategori == 'Lampu' || $kategori == 'Saklar' || $kategori == 'StopKontak')
                        <!-- Upah -->
                        <div class="mt-4">
                            <x-label for="upah" :value="__('Upah Pemasangan')" />

                            <x-input wire:model.defer="upah" id="upah" class="block w-full mt-1" type="number"
                                name="upah" />
                            <span class="text-sm text-danger">
                                @error('upah')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    @endif



                </div>
                <div class="px-4">
                    <div class="flex items-center justify-between mt-8">
                        <button type="submit" class="text-sm font-medium btn-primary">Submit</button>
                        <a href="{{ route('barang') }}" class="text-sm font-medium btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
