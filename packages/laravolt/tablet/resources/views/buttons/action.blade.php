<div class="ui icon buttons mini basic">
    <a class="ui button" href="{{ $view }}"><i class="eye icon"></i></a>
    <a class="ui button" href="{{ $edit }}"><i class="edit icon"></i></a>

    <form role="form" action="{{ $delete }}" method="POST" onsubmit="return confirm('Anda yakin?')">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
        <button type="submit" class="ui button"><i class="delete icon"></i></button>
    </form>
</div>
