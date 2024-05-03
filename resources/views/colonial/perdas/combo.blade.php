

<div class="row"> 
    <div class="col-md-6 ">
        <div class="  " >
            <label for="fname"><strong> Produto: </strong> <span class="red normal">*</span></label> 
        </div>
    </div>
    <div class="col-md-4">
        <div class="  ">
            <label for="fname"><strong>Tipo de Perda:</strong> <span class="red normal">*</span></label> 
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="  ">
            <label for="fname"><strong>Qtde.:</strong> <span class="red normal">*</span></label> 
        </div>
    </div>
</div>

@foreach ($dados as $produto )
    <input type="hidden" name="produto[]" value="{{ $produto->itemcode }}">
    <div class="row"> 
        <div class="col-md-6  ">
            <div class="form-group @if($errors->has('produto')) has-error @endif ">  
                <div class="form-control" style="text-align: left;">{{ $produto->dscription }}</div>
                </div>
                @if($errors->has('produto'))
                    <div class="error">{{ $errors->first('produto') }}</div>
                @endif
            </div>
        
        <div class="col-md-4">
            <div class="form-group @if($errors->has('tipo')) has-error @endif "> 
                <select class="form-control" name="tipo[]"  >
                    <option value="">SELECIONE</option> 
                    @foreach ($tipo as $valor )
                        <option value="{{ $valor->cd_tipo }}" @if(old('tipo')== $valor->cd_tipo) selected  @endif >{!!   $valor->nm_tipo   !!}</option> 
                    @endforeach
                </select>
                @if($errors->has('tipo'))
                    <div class="error">{{ $errors->first('tipo') }}</div>
                @endif
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="form-group @if($errors->has('qtde')) has-error @endif "> 
                <input type="number" class="form-control "   value="{{old('tempo')}}" placeholder="Qtde" name="qtde[]"   />
                @if($errors->has('qtde'))
                    <div class="error">{{ $errors->first('qtde') }}</div>
                @endif
            </div>
        </div>
    </div>

@endforeach