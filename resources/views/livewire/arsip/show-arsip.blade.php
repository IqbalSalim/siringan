<div x-cloak x-data="{ modalDetail: false }">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail RAB') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div class="hover:text-primary"><a href="/arsip-rab">Arsip RAB</a></div>
            <div>-</div>
            <div>Detail RAB</div>
        </div>
    </x-slot>
    <livewire:arsip.detail-arsip></livewire:arsip.detail-arsip>

    <div class="px-4 py-12 md:px-6 lg:px-8">

        <div class="px-4 py-4 bg-white rounded-lg shadow-lg">
            <div class="flex flex-row justify-between">
                <div class="flex flex-row space-x-4">
                    <button class="text-sm btn-primary" onclick="window.print()">Cetak</button>
                    <button class="text-sm btn-warning" @click="modalDetail = true"
                        wire:click="$emit('getRuangan', {{ $idRab }})">Detail</button>
                </div>
                <a href="{{ route('arsip-rab') }}" class="text-sm btn-info">Kembali ke arsip RAB</a>
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
                                class="py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-4/12px-2 md:px-6">
                                Nama Barang
                            </th>
                            <th scope="col"
                                class="py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-4/12px-2 md:px-6">
                                <span class="sr-only">Ruangan : xxxx</span>
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Jumlah
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Satuan
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Harga
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Sub Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($rabs as $key => $rab)
                            @if ($rab['watt'] !== null)
                                @foreach ($lampu as $row)
                                    @if ($no == 0)
                                        <tr>
                                            <td rowspan="{{ count($lampu) }}"
                                                class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                                {{ $no += 1 }}
                                            </td>
                                            <td rowspan="{{ count($lampu) }}" class="px-2 py-4 md:px-6">
                                                {{ $rab['nama'] . ' ' . $rab['watt'] . ' watt' }}
                                            </td>
                                            <td>{{ $row['ruangan'] }} : {{ $row['jumlah'] }}</td>
                                            <td rowspan="{{ count($lampu) }}" class="px-2 py-4 md:px-6">
                                                {{ $rab['jumlah'] }}
                                            </td>
                                            <td rowspan="{{ count($lampu) }}" class="px-2 py-4 md:px-6">
                                                {{ $rab['satuan'] }}
                                            </td>
                                            <td rowspan="{{ count($lampu) }}" class="px-2 py-4 md:px-6">
                                                {{ currency_IDR($rab['harga']) }}
                                            </td>
                                            <td rowspan="{{ count($lampu) }}" class="px-2 py-4 md:px-6">
                                                {{ currency_IDR($rab['subTotal']) }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $row['ruangan'] }} : {{ $row['jumlah'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @elseif ($rab['jenis'] == 'SKB')
                                @php
                                    $cekSK = 0;
                                @endphp
                                @foreach ($stopKontak as $row)
                                    @if ($cekSK == 0)
                                        <tr>
                                            <td rowspan="{{ count($stopKontak) }}"
                                                class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                                {{ $no += 1 }}
                                            </td>
                                            <td rowspan="{{ count($stopKontak) }}" class="px-2 py-4 md:px-6">
                                                {{ $rab['nama'] }}
                                            </td>
                                            <td>{{ $row['ruangan'] }} : {{ $row['jumlah'] }}</td>
                                            <td rowspan="{{ count($stopKontak) }}" class="px-2 py-4 md:px-6">
                                                {{ $rab['jumlah'] }}
                                            </td>
                                            <td rowspan="{{ count($stopKontak) }}" class="px-2 py-4 md:px-6">
                                                {{ $rab['satuan'] }}
                                            </td>
                                            <td rowspan="{{ count($stopKontak) }}" class="px-2 py-4 md:px-6">
                                                {{ currency_IDR($rab['harga']) }}
                                            </td>
                                            <td rowspan="{{ count($stopKontak) }}" class="px-2 py-4 md:px-6">
                                                {{ currency_IDR($rab['subTotal']) }}
                                            </td>
                                        </tr>
                                        @php
                                            $cekSK++;
                                        @endphp
                                    @else
                                        <tr>
                                            <td>{{ $row['ruangan'] }} : {{ $row['jumlah'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                        {{ $no += 1 }}
                                    </td>

                                    <td colspan="1" class="px-2 py-4 md:px-6">
                                        {{ $rab['nama'] }}
                                    </td>
                                    <td></td>

                                    <td class="px-2 py-4 md:px-6">
                                        {{ $rab['jumlah'] }}
                                    </td>
                                    <td class="px-2 py-4 md:px-6">
                                        {{ $rab['satuan'] }}
                                    </td>
                                    <td class="px-2 py-4 md:px-6">
                                        {{ currency_IDR($rab['harga']) }}
                                    </td>
                                    <td class="px-2 py-4 md:px-6">
                                        {{ currency_IDR($rab['subTotal']) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="pr-4 font-semibold text-right">Total Harga Barang</td>
                            <td class="px-2 py-4 md:px-6">{{ currency_IDR($totalHargaBarang) }}</td>
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
                                class="w-6/12 px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Nama Barang
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Jumlah
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Upah
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
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
                                    {{ currency_IDR($row['upah']) }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ currency_IDR($row['subTotal']) }}
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="pr-4 font-semibold text-right">Total Upah</td>
                            <td class="px-2 py-4 md:px-6">{{ currency_IDR($totalUpah) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="pr-4 font-semibold text-right">Total = Total Harga Barang + Total
                                Upah</td>
                            <td class="px-2 py-4 text-green-600 md:px-6">
                                {{ currency_IDR($totalUpah + $totalHargaBarang) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
