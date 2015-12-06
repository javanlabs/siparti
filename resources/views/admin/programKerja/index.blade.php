@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        {!! Tablet::source($programKerja)
        ->title('Program Kerja')
        ->addToolbar(render('admin.programKerja.toolbar.create'))
        ->addToolbar(render('tablet::toolbars.delete', ['url' => route('admin.programKerja.destroy', ':ids')]))
        ->columns([
            new \Laravolt\Tablet\Components\Checkall(),
            ['header' => 'Nama', 'field' => 'name'],
            ['header' => 'Fase', 'present' => 'fase_sekarang'],
            ['header' => 'Satuan Kerja', 'present' => 'satker_name'],
            ['header' => 'Ditambahkan Oleh', 'present' => 'creator_name'],
            ['header' => 'Ditambahkan Pada', 'present' => 'date_for_human'],
            ['view' => 'admin.programKerja.action']
        ])
        ->render() !!}
    </div>
@endsection
