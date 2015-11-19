@extends('admin.layouts.base')

@section('content')
    <div class="ui container">
        <h2>Uji Publik {{ $item->present('id') }}</h2>

        <table class="ui definition table">
            <tbody>
                <tr><td>Id</td><td>{{ $item->present('id') }}</td></tr>
                <tr><td>Name</td><td>{{ $item->present('name') }}</td></tr>
            </tbody>
        </table>
    </div>
@endsection