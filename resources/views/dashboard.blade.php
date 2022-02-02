<x-app-layout>
    @if (request()->has('failed'))
    <div style="justify-content: center;" id="alert-border-2" class="text-center flex p-4 mb-4 bg-red-100 border-t-4 border-red-500 dark:bg-red-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div class="ml-3 text-sm font-medium text-center text-red-700">
                Tivemos um erro aqui <br /> Erro ao cadastrar url, verifique a URL informada! Erro: 002
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 dark:bg-red-200 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 dark:hover:bg-red-300 inline-flex h-8 w-8"  data-collapse-toggle="alert-border-2" aria-label="Close">
          <span class="sr-only px-4">X</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    @endif
    @if (request()->has('success'))
    <div style="justify-content: center;" id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
            URL cadastrada com sucesso!
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-collapse-toggle="alert-3" aria-label="Close">
          <span class="sr-only px-4 ">X</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </div>
    @endif
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
                        <form method="POST" action="verify">
                            @csrf
                            <label for="title">url</label>

                            <input name="url" id="title" type="text"
                                class="@error('title') is-invalid @enderror input read-only:bg-gray-100 rounded-lg">
                            <button style="background: lightblue; border-radius: 10px; padding:2px 5px " type="submit"
                                class="btn btn-primary " onclick="confirm('deseja adicionar url?')" >Enviar</button>

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
                            <th scope="col">Excluir </th>
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
                                        <button style="background: lightgreen; border-radius: 10px; padding:2px 5px "
                                            class=" text-center bg-sky-600 hover:bg-sky-700  hover:bg-green-400 active:bg-violet-600 focus:outline-none focus:ring focus:ring-green-300">
                                            <a href="http://{{ $url['url'] }}" target="_blank"> Verificar
                                            </a></button>
                                    </td>
                                @else
                                    <td class="p-3 " style="color:red; font-weight: bold"> NÃO VERIFICADO
                                    </td>
                                    <td> &nbsp; </td>

                                @endif
                                <td class="px-2">
                                    <form method="POST" action="verify/{{$url['id']}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <input onclick="confirm('deseja remover a url?')" style="color:black;  background: rgb(250, 95, 81); border-radius: 10px; padding:2px 5px " type="submit" class="btn btn-danger delete-user" value="Excluir" >
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</x-app-layout>
