<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Arsip RAB') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div>Arsip RAB</div>
        </div>
    </x-slot>


    <div class="px-4 py-12 md:px-6 lg:px-8">
        @if (session()->has('message'))
            <div class="block px-4 py-2 my-2 text-white bg-opacity-50 bg-success rounded-xl">
                {{ session('message') }}
            </div>
        @endif
        <div class="px-4 py-4 bg-white rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto md:overflow-hidden">
                <table class="min-w-full mt-2 divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr class="">
                            <th scope="col"
                                class="w-1/12 px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                #
                            </th>
                            <th scope="col"
                                class="w-3/12 px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Tanggal Dibuat
                            </th>
                            <th scope="col"
                                class="w-3/12 px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Nama Bangunan
                            </th>
                            <th scope="col"
                                class="w-full px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase md:px-6">
                                Rincian Ruangan
                            </th>
                            <th scope="col"
                                class="px-2 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                <span class="sr-only">Detail</span>
                                <span class="sr-only">Edit</span>
                                <span class="sr-only">Hapus</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($rabs as $key => $rab)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-500 md:px-6 whitespace-nowrap">
                                    {{ $key + 1 }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $rab->created_at }}
                                </td>
                                <td class="px-2 py-4 md:px-6">
                                    {{ $rab->nama_rumah }}
                                </td>
                                <td class="px-2 py-4 text-xs md:px-6">
                                    @php
                                        $data = json_decode($rab->data);
                                        foreach ($data as $key => $value) {
                                            echo $value->ruangan . ', ';
                                        }
                                    @endphp
                                </td>
                                <td class="px-2 md:px-6">
                                    <div class="flex flex-row items-center space-x-4">
                                        <form action="{{ url('/detail-rab') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="idRab" value="{{ $rab->id }}">
                                            <button type="submit" class="text-xs btn-primary">detail</button>
                                        </form>


                                        <a href="{{ route('edit-rab', $rab->id) }}" type="submit"
                                            class="text-xs btn-info">edit</a>
                                        <button wire:click.prevent="delete({{ $rab->id }})" type="button"
                                            class="text-xs btn-danger">hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
