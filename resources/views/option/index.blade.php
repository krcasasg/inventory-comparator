@extends('layouts.base')
@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-1">
            <h1 class="text-4xl font-bold mb-4">OPTIONS</h1>
        </div>
        @if (session()->has('success'))
            <div class="grid grid-columns-1">
                <div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                <span class="inline-block align-middle mr-8">
                    {{ session('success') }}
                </span>
                    <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif
        @if (session()->has('errors'))
            <div class="grid grid-columns-1">
                <div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                <span class="inline-block align-middle mr-8">
                    {{ session('errors') }}
                </span>
                    <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="grid grid-cols-1">
            <form action="{{route('options.store')}}" method="post">
                @csrf
                @method('post')
                <div class="grid grid-cols-1">
                    <p>Create new option, requires name and value.  Then click in create</p>
                </div>
                <div class="grid grid-cols-3 gap-4 border p-2">
                    <div>
                        <input type="text" name="name" id="name" placeholder="name" required class=" m-2 p-2 w-full">
                    </div>
                    <div>
                        <input type="text" name="value" id="value" placeholder="value" required class=" m-2 p-2 w-full">
                    </div>
                    <div>
                        <input type="submit" value="Create New Option" class=" m-2 p-2 w-full bg-blue-500 hover:bg-indigo-700 text-white">
                    </div>
                </div>
            </form>
        </div>

        @unless(empty($options))
            <div class="grid grid-cols-1">
                <h2 class="text-center text-2xl my-3">Options in the database</h2>
            </div>
        <div class="grid grid-cols-1">
            <table class="table-auto border-black border-solid">
                <thead>
                    <tr>
                        <th class="border-solid border-black border-2 p-2">ID</th>
                        <th class="border-solid border-black border-2 p-2">NAME</th>
                        <th class="border-solid border-black border-2 p-2">VALUE</th>
                        <th class="border-solid border-black border-2 p-2">EDIT</th>
                        <th class="border-solid border-black border-2 p-2">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($options as $option)
                    <tr>
                        <td class="border-solid border-black border-2 p-2">{{$option->id}}</td>
                        <td class="border-solid border-black border-2 p-2">{{$option->name}}</td>
                        <td class="border-solid border-black border-2 p-2">{{$option->value}}</td>
                        <td class="border-solid border-black border-2 p-2"><a href="{{ route('options.edit',$option)}}" class="w-full p-1 bg-yellow-500 hover:bg-yellow-700 text-black text-center block">Edit</a></td>
                        <td class="border-solid border-black border-2 p-2">
                            <form action="{{route('options.destroy', $option->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="bg-red-500 hover:bg-red-700 text-white p-1 w-full">
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
       </div>
        @else
            <p>Nada que mostrar</p>
        @endif
    </div>
@endsection
