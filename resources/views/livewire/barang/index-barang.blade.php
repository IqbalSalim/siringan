<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Bahan') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div>Bahan</div>
        </div>
    </x-slot>

    <div class="px-4 py-12 md:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="block px-4 py-2 my-2 text-white bg-opacity-50 bg-success rounded-xl">
                {{ session('message') }}
            </div>
        @endif
        <div class="px-4 py-4 bg-white rounded-lg shadow-lg">
            <div class="py-2 border-b-2 border-gray-200">
                <a href="{{ url('create-barang') }}" class="text-sm btn-primary">Tambah Bahan</a>
            </div>
            <div class="flex flex-row items-center justify-between py-2">
                <div>
                    <select name="paginate" id="paginate" wire:model="paginate"
                        class="block w-full text-sm capitalize border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>
                <div class="md:w-3/12">
                    <x-input wire:model="search" id="search" class="block w-full text-sm" placeholder="Search..."
                        type="text" name="search" autofocus />
                </div>
            </div>
            <div class="w-full overflow-x-auto md:overflow-hidden">
                <table class="min-w-full mt-2 divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr class="">
                            <th scope="col"
                                class="w-1/12 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                #
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Nama Barang
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Satuan
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Harga
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Upah
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                <span class="sr-only">Edit</span>
                                <span class="sr-only">Hapus</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($barangs as $key => $barang)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    @if ($barang['watt'] !== null)
                                        {{ $barang['nama'] . ' ' . $barang['watt'] . ' watt' }}
                                    @else
                                        {{ $barang['nama'] }}
                                    @endif
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $barang['satuan'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $barang['harga'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $barang['upah'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    <div class="flex flex-row items-center space-x-4">
                                        <form action="{{ url('/update-barang') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idBarang" value="{{ $barang->id }}">
                                            <button type="submit" class="text-xs btn-info">edit</button>
                                        </form>
                                        <button wire:click.prevent="delete({{ $barang->id }})" type="button"
                                            class="text-xs btn-danger">hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
                {{ $barangs->links() }}
            </div>
        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
