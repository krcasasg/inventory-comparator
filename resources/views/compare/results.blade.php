@extends('layouts.base')
@section('content')
<div class="container mx-auto">
    <div class=" grid grid-1 border m-2 p-3">
        <h1 class="text-4xl">Results from inventory</h1>
    </div>
    <div class=" grid grid-1 m-2 p-3">
        <span class="float-right">
            <a href="{{url('/compare/download')}}" class="p-2 bg-green-500 text-white">Download results</a>
        </span>

    </div>
    <div class=" grid grid-1 border m-2 p-3">
        <h2 class="text-center font-bold text-blue-600 text-xl uppercase py-2">Products</h2>
        @if(!empty($items))
            <table class="table-auto border-collapse">
                <thead>
                <tr>
                    <td class="border text-center font-bold border-blue-400 p-2">Key</td>
                    <td class="border text-center font-bold border-blue-400 p-2">Quantity</td>
                    <td class="border text-center font-bold border-blue-400 p-2">Status</td>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="border border-blue-400 p-2">{{ $item['key'] }}</td>
                        <td class="border border-blue-400 text-right p-2">{{ $item['quantity'] }}</td>
                        <td class="border border-blue-400 text-right p-2">{{ $item['status'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-red-600 text-lg">There are no products.</p>
        @endif
    </div>

</div>
@endsection
