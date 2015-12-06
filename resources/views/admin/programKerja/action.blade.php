<div class="ui icon buttons mini basic">
    <a class="ui button" href="{{ route('admin.programKerja.edit', $data->id) }}"><i class="edit icon"></i></a>

    <form role="form" action="{{ route('admin.programKerja.destroy',  $data->id) }}" method="POST" onsubmit="return confirm('Anda yakin?')">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
        <button type="submit" class="ui button"><i class="delete icon"></i></button>
    </form>
</div>
