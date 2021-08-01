@extends('layouts.base')
@section('content')
    <div class="container-mx-auto">
        <div class="grid grid-columns-1">
            <h1 class="font-bold text-4xl my-3 px-3">Options Edit</h1>
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
                <div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500">
                <span class="inline-block align-middle mr-8">
                    {{ session('errors') }}
                </span>
                    <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="grid grid-columns-1">
            <p class="mx-auto">Insert name option and value, then press Save option button</p>
        </div>
        <div class="grid grid-columns-1">

            <form action="{{route('options.update', $option->id)}}" method="post">
                @csrf
                @method('put')
                <div class="grid grid-columns-1 w-2/4 mx-auto">
                    <label for="name" class="text-blue-500 py-2">Name</label>
                    <input type="text" name="name" id="name" value="{{$option->name ?? ''}}" class="p-2 my-2">
                </div>
                <div class="grid grid-columns-1 w-2/4 mx-auto">
                    <label for="value" class="text-blue-500 py-2">Value</label>
                    <input type="text" name="value" id="value" value="{{$option->value ?? ''}}" required class="p-2 my-2">
                </div>
                <div class="grid grid-columns-1 w-2/4 mx-auto">
                    <input type="submit" value="Save Option" class="my-3 py-2 bg-blue-500 hover:bg-blue-600 text-white">
                </div>
            </form>
        </div>
    </div>
@endsection
