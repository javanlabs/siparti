@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        {!! Tablet::source($ujiPublik)
        ->title('Uji Publik')
        ->baseRoute('admin.ujiPublik')
        ->addToolbar(render('tablet::buttons.create', ['url' => route('admin.ujiPublik.create')]))
        ->addToolbar(render('tablet::toolbars.delete', ['url' => route('admin.ujiPublik.destroy', ':ids')]))
        ->columns([
            new \Laravolt\Tablet\Components\Checkall(),
            ['header' => 'Nama', 'field' => 'name'],
            ['header' => 'Ditambahkan Oleh', 'present' => 'creator_name'],
            ['header' => 'Ditambahkan Pada', 'present' => 'created_at'],
            new \Laravolt\Tablet\Components\Action()
        ])
        ->render() !!}
    </div>
@endsection
