@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        {!! Tablet::source($programKerja)
        ->title('Program Kerja')
        ->baseRoute('admin.faseProgramKerja')
        ->addToolbar(render('tablet::buttons.create', ['url' => route('admin.faseProgramKerja.create')]))
        ->addToolbar(render('tablet::toolbars.delete', ['url' => route('admin.faseProgramKerja.destroy', ':ids')]))
        ->columns([
            new \Laravolt\Tablet\Components\Checkall(),
            ['header' => 'Nama', 'present' => 'name'],
            ['header' => 'Fase', 'present' => 'label'],
            ['header' => 'Instansi Terkait', 'present' => 'instansi_terkait'],
            ['header' => 'Satuan Kerja', 'present' => 'satker'],
            ['header' => '<i class="comments icon"></i>', 'present' => 'komentar'],
            ['header' => '<i class="thumbs up icon"></i>', 'present' => 'dukungan'],
            ['header' => '<i class="thumbs down icon"></i>', 'present' => 'penolakan'],
            new \Laravolt\Tablet\Components\Action()
        ])
        ->render() !!}
    </div>
@endsection
