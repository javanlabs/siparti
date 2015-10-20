@extends('admin.layouts.base')
@section('content')
    <div class="ui container">
        <div class="ui grid">
            <div class="column sixteen wide">
                <div class="ui top attached menu">
                    <div class="menu">
                        <div class="item borderless">
                            <h4>@lang('roles.title')</h4>
                        </div>
                    </div>
                </div>
                <div class="ui segment attached fitted">
                    <table class="ui very compact table bottom small sortable">
                        <thead>
                        <tr>
                            <th>@lang('roles.name')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role['name'] }}</td>
                                <td class="right aligned"><a href="{{ route('admin.roles.edit', $role['id']) }}" class="ui button basic mini">@lang('roles.manage')</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
