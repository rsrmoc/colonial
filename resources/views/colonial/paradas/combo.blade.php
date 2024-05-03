
@if(empty($request['perda'])) 
    <select class="form-control" name="produto"  >
        <option value="">SELECIONE</option> 
        @foreach ($dados as $valor )
            <option value="{{ $valor->DocEntry }}" @if(old('ordem')== $valor->DocEntry) selected  @endif >{!!   $valor->DocEntry . ' - '. date( 'd/m/Y' , strtotime( $valor->DueDate ) ) .  ' [ '.$valor->ProdName.' ] ' !!}</option> 
        @endforeach
    </select> 
@endif


@if($request['perda']==true) 
<select class="form-control" onchange="carregar(this.value)" name="ordem"  >
    <option value="">SELECIONE</option> 
    @foreach ($dados as $valor )
        <option value="{{ $valor->DocEntry }}" @if(old('ordem')== $valor->DocEntry) selected  @endif >{!!   $valor->DocEntry . ' - '. date( 'd/m/Y' , strtotime( $valor->DueDate ) ) .  ' [ '.$valor->ProdName.' ] ' !!}</option> 
    @endforeach
</select>
@endif