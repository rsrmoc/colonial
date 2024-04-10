
<select class="form-control" name="produto"  >
    <option value="">SELECIONE</option> 
    @foreach ($dados as $valor )
        <option value="{{ $valor->itemcode }}"   >{!!   $valor->itemcode.' - '.$valor->dscription   !!}</option> 
    @endforeach
</select>