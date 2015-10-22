<div class="ui sidebar inverted vertical menu sidebar-admin">
    @can('manage-users')<a href="{{ route('admin.users.index') }}" class="item">Users</a>@endcan
    @can('manage-roles')<a href="{{ route('admin.roles.index') }}" class="item">Roles</a>@endcan
    @can('manage-settings')<a href="{{ route('admin.settings.index') }}" class="item">Settings</a>@endcan
</div>
