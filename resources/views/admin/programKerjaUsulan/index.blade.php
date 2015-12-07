@extends('admin.layouts.base')

@section('content')

    <div class="ui container">
        {!! Tablet::source($programKerjaUsulan)
        ->title('Usulan Program Kerja')
        ->baseRoute('admin.programKerjaUsulan')
        ->addToolbar(render('tablet::buttons.create', ['url' => route('admin.programKerjaUsulan.create')]))
        ->addToolbar(render('tablet::toolbars.delete', ['url' => route('admin.programKerjaUsulan.destroy', ':ids')]))
        ->columns([
            new \Laravolt\Tablet\Components\Checkall(),
            ['header' => 'Nama', 'present' => 'name'],
            ['header' => 'Dibuat Oleh', 'present' => 'creator_name'],
            ['header' => 'Instansi Terkait', 'present' => 'instansi_terkait'],
            ['header' => '<i class="comments icon"></i>', 'present' => 'komentar'],
            ['header' => '<i class="thumbs up icon"></i>', 'present' => 'dukungan'],
            ['header' => '<i class="thumbs down icon"></i>', 'present' => 'penolakan'],
            new \Laravolt\Tablet\Components\Action()
        ])
        ->render() !!}
    </div>
@endsection
