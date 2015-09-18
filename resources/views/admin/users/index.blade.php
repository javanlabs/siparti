@extends('admin.layouts.base')
@section('content')
    <div class="ui container">
        <div class="ui top attached menu">
            <div class="menu">
                <div class="item borderless">
                    <h4>@lang('users.title')</h4>
                </div>
            </div>
            <div class="right menu">
                {{--<div class="ui dropdown item">--}}
                {{--<div class="text">Semua Status</div> <i class="dropdown icon"></i>--}}
                {{--<div class="menu">--}}
                {{--<a href="" class="item">Semua (90)</a>--}}
                {{--@foreach(\App\Enum\UserStatus::values() as $key=>$value)--}}
                {{--<a href="" class="item">{{ $value }}</a>--}}
                {{--@endforeach--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="ui dropdown item">--}}
                {{--Semua Role <i class="dropdown icon"></i>--}}
                {{--<div class="menu">--}}
                {{--<a href="" class="item">Semua (90)</a>--}}
                {{--@foreach(\App\Enum\UserStatus::values() as $key=>$value)--}}
                {{--<a href="" class="item">{{ $value }}</a>--}}
                {{--@endforeach--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="ui right aligned item">
                    <form action="">
                        <div class="ui transparent icon input">
                            <input class="prompt" name="search" value="{{ request('search') }}" type="text" placeholder="@lang('users.search')">
                            <i class="search link icon"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="ui segment attached fitted">
            <table class="ui very compact table bottom small sortable">
                <thead>
                <tr>
                    @sortby('name', trans('users.name'))
                    @sortby('email', trans('users.email'))
                    <th>@lang('users.status')</th>
                    @sortby('created_at', trans('users.registered_at'))
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <?php $user = $user->presenter()['data'];?>
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['status'] }}</td>
                        <td>{{ $user['registered_at'] }}</td>
                        <td class="right aligned"><a href="{{ route('admin.users.edit', $user['id']) }}" class="ui button basic mini">@lang('users.manage')</a></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="warning center aligned" style="font-size: 1.5rem;padding:40px;font-style: italic">Data tidak tersedia</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="ui menu bottom attached">
            <div class="item borderless">
                <small>{!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($users))->summary() !!}</small>
            </div>
            {!! with(new \Laravolt\Support\Pagination\SemanticUiPagination($users))->render('attached bottom right') !!}
        </div>
    </div>
@endsection
