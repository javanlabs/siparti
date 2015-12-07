@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        {!! Tablet::source($comments)
        ->title('Komentar')
        ->baseRoute('admin.comments')
        ->addToolbar(render('tablet::toolbars.delete', ['url' => route('admin.comments.destroy', ':ids')]))
        ->columns([
            new \Laravolt\Tablet\Components\Checkall(),
            ['header' => 'Komentar', 'present' => 'content'],
            ['header' => 'Oleh', 'present' => 'author_name'],
            ['header' => 'Pada', 'present' => 'created_at'],
            (new \Laravolt\Tablet\Components\Action())->only(['delete'])
        ])
        ->render() !!}
    </div>
@endsection
