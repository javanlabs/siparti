<div class="six wide column">
    <div class="ui segment">
        <h3 class="ui header">Program Kerja Usulan Terkait</h3>
                    
        <div class="ui form">
            <div class="fields inline">
                <select id="optionProgramKerja" class="ui dropdown fluid search selection">

                <?php $arrayId = []; ?>
              
                <?php $arrayName = []; ?>
                                
                @foreach ($programKerja->present('usulan') as $kerjaUsulan)
                    {!! $arrayId[] = $kerjaUsulan->id !!}
                    {!! $arrayName[] = $kerjaUsulan->name !!}  
                @endforeach

                @foreach ($usulan as $data)
                    @if (!in_array($data->present('id'), $arrayId) and !in_array($data->present('name'), $arrayName))
                        <option value="{{ $data->present('id') }}">{{ $data->present('name') }}</option>
                    @endif
                @endforeach

                </select>
                &nbsp;
                <button id="addProgramKerja" class="ui button icon green"><i class="icon plus"></i></button>
            </div>
        </div>

        <div class="ui divider"></div>

        <div id="programKerjaContainer" class="ui middle aligned divided list relaxed">
                        
        @foreach($programKerja->present('usulan') as $data)
              
            <div class="item">
                <div class="right floated content">
                        <div data-text="{{ $data->name }}" data-val="{{ $data->id }}" class="ui button mini hapus">Hapus</div>
                    </div>
                <div class="content">{{ $data->name }}</div>
            </div>
            
        @endforeach
                    
        </div>
    </div>
</div>