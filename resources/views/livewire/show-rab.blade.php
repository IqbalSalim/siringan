<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('RAB') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div class="hover:text-primary"><a href="/buat-rab">Buat RAB</a></div>
            <div>-</div>
            <div>RAB</div>
        </div>
    </x-slot>

    <div class="px-4 py-12 md:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="block px-4 py-2 my-2 text-white bg-opacity-50 bg-success rounded-xl">
                {{ session('message') }}
            </div>
        @endif
        <div class="px-4 py-4 bg-white rounded-lg shadow-lg">
            <div class="flex flex-row justify-between">
                <button class="text-sm btn-primary">Cetak</button>
                <a href="/dashboard" class="text-sm btn-info">Kembali ke dashboard</a>
            </div>
            <h2 class="pt-3 font-medium">Tabel Barang</h2>
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
                                Jumlah
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
                                Sub Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($rabs as $key => $rab)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                    {{ $no += 1 }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    @if ($rab['watt'] !== null)
                                        {{ $rab['nama'] . ' ' . $rab['watt'] . ' watt' }}
                                    @else
                                        {{ $rab['nama'] }}
                                    @endif
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $rab['jumlah'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $rab['satuan'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $rab['harga'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $rab['subTotal'] }}
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="pr-4 font-semibold text-right">Total Harga Barang</td>
                            <td class="px-2 py-4 md:px-6">{{ $totalHargaBarang }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h2 class="pt-3 font-medium">Tabel Upah</h2>
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
                                Jumlah
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Upah
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Sub Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($tabelUpah as $key => $row)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                    {{ $no += 1 }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    @if ($row['watt'] !== null)
                                        {{ $row['nama'] . ' ' . $row['watt'] . ' watt' }}
                                    @else
                                        {{ $row['nama'] }}
                                    @endif
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['jumlah'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['upah'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['subTotal'] }}
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="pr-4 font-semibold text-right">Total Upah</td>
                            <td class="px-2 py-4 md:px-6">{{ $totalUpah }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="pr-4 font-semibold text-right">Total = Total Harga Barang + Total
                                Upah</td>
                            <td class="px-2 py-4 text-green-600 md:px-6">{{ $totalUpah + $totalHargaBarang }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
