<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <h1 class="text-center">CADASTRO DE URL</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4"
                style="display: flex;justify-content: center;">
                <div class="row">
                    <h3 style="color:rgba(0, 0, 0, 0.592)" class="text-center p-2">*apenas 1 url por vez </h3>
                    <div class="col-12">
                        <form method="POST" action="api/verify">
                            @csrf
                            <label for="title">url</label>

                            <input name="url" id="title" type="text" class="@error('title') is-invalid @enderror input read-only:bg-gray-100 rounded-lg">
                            <button style="background: lightblue; border-radius: 10px; padding:2px 5px " type="submit" class="btn btn-primary ">Enviar</button>

                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>

                    <h3 style="color:rgba(0, 0, 0, 0.592)" class="text-center p-2">*varias url por vez (json) </h3>
                    <div class="col-12">
                        <form method="POST" action="api/verify">
                            @csrf
                            <label for="title">url</label>
                            <textarea id="title" type="text" class="@error('title') is-invalid @enderror input read-only:bg-gray-100 rounded-lg"> </textarea>
                            <button style="background: lightblue; border-radius: 10px; padding:2px 5px " type="submit" class="btn btn-primary ">Enviar</button>

                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="py-1">
        <h2 class="text-center">URL SOLICITADAS</h2>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4"
                style="display: flex;justify-content: center;">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">URL</th>
                            <th scope="col">Testado</th>
                            <th scope="col">HTTP</th>
                            <th scope="col">Conteúdo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($urls as $url)
                            <tr class="text-center">
                                <th scope="row">{{ $url['id'] }}</th>
                                <td>
                                    <p class="text-center px-3">{{ $url['url'] }}
                                    <p>
                                </td>
                                @if ($url['tested'] === 1)
                                    <td class="px-4" style="color:green; font-weight: bold"> VERIFICADO</td>
                                    <td class="px-4" style="font-weight: bold">
                                        @foreach ($data as $urlData)
                                            @if ($urlData['url_id'] === $url['id'])
                                                @if ($urlData['http'] == 200)
                                                    <p style="color:green; ">{{ $urlData['http'] }} </p>
                                                @else
                                                    <p style="color:rgb(255, 0, 0); ">{{ $urlData['http'] }} </p>
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-3">
                                        <button href="{{ $url['url'] }}"
                                            style="background: lightgreen; border-radius: 10px; padding:2px 5px "
                                            class=" text-center bg-sky-600 hover:bg-sky-700  hover:bg-green-400 active:bg-violet-600 focus:outline-none focus:ring focus:ring-green-300">
                                            Verificar </button>
                                    </td>
                                @else
                                    <td class="p-3 " style="color:red; font-weight: bold"> NÃO VERIFICADO
                                    </td>
                                    <td> &nbsp; </td>

                                @endif


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</x-app-layout>
