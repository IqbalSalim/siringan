<div class="fixed inset-0 z-50 flex justify-center w-full py-4 bg-black bg-opacity-40" x-show="modalDetail">

    <!-- A basic modal dialog with title, body and one button to close -->

    <div @click.away="modalDetail = false" x-show="modalDetail" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="flex flex-col w-8/12 h-auto p-4 mx-2 my-auto text-left transition-all duration-500 ease-in-out transform bg-white divide-y-2 divide-gray-300 rounded shadow-xl">


        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                Detail RAB
            </h3>
        </div>

        <div class="flex flex-col flex-1 px-4 py-2 overflow-auto h-96">
            <table class="min-w-full mt-2 divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                    <tr class="">
                        <th scope="col"
                            class="w-1/12 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                            #
                        </th>
                        <th scope="col"
                            class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                            Ruangan
                        </th>
                        <th scope="col"
                            class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                            Panjang
                        </th>
                        <th scope="col"
                            class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                            Lebar
                        </th>
                        <th scope="col"
                            class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                            Tinggi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($ruangans != null)
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($ruangans as $row)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                    {{ $no += 1 }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['ruangan'] }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['panjang'] . ' m' }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['lebar'] . ' m' }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $row['tinggi'] . ' m' }}
                                </td>
                            </tr>
                        @endforeach

                    @endif
                    <!-- More people... -->
                </tbody>
            </table>

        </div>
        <div>
            <div class="flex items-center justify-between mt-8">
                <button type="button" @click="modalDetail = false" class="text-sm btn-secondary">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
