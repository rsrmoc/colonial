<?php

use App\Models\Boleto;
use App\Models\Bot;

const CONTROLE_DATA = [
    'V' => 'dt_vencimento',
    'P' => 'dt_pago',
    'E' => 'dt_emissao' 
];
 
function PAGINACAO_HTML($pagina){
    
    $_limit=$pagina['linha_pagina'];
    $_total=$pagina['total'];
    $links = 7; 
    $_page = $pagina['pag_atual']; 
    $list_class = " pagination ";
     
    $last       = ceil( $_total / $_limit );
 
    $start      = ( ( $_page - $links ) > 0 ) ? $_page - $links : 1;
    $end        = ( ( $_page + $links ) < $last ) ? $_page + $links : $last;
     
    
    $html       = '<ul class="' . $list_class . '">';
 
    $class      = ( $_page == 1 ) ? "disabled" : "";
    $html       .= '<li class=" page-item ' . $class . '"><a href="#" x-on:click="setPageBoletos(' . ( $_page  ) . ')" >Anterior</a></li>';
 
    if ( $start > 1 ) {
        $html   .= '<li><a href="?limit=' . $_limit . '&page=1">1</a></li>';
        $html   .= '<li class=" page-item disabled"><span>...</span></li>';
    }
 
    for ( $i = $start ; $i <= $end; $i++ ) {
        $class  = ( $_page == $i ) ? "active" : "";
        $html   .= '<li class=" page-item ' . $class . '"><a href="#" x-on:click="setPageBoletos(' . ( $i  ) . ')">' . $i . '</a></li>';
    }
 
    if ( $end < $last ) {
        $html   .= '<li class=" page-item disabled"><span>...</span></li>';
        $html   .= '<li ><a href="#" x-on:click="setPageBoletos(' . ( $last ) . ')">' . $last . '</a></li>';
    }
 
    $class      = ( $_page == $last ) ? "disabled" : "";
    $html       .= '<li class=" page-item ' . $class . '"><a href="#" x-on:click="setPageBoletos(' . ( $_page ) . ')">Próximo</a></li>';
 
    $html       .= '</ul>';
 
    return $html;






    /*
    $Pag='
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Anterior</a>
            </li>';
            for ($x = 1; $x <= ( ($pagina['ultima_pagina']>10)? 10 : $pagina['ultima_pagina'] ); $x++) {

                $Pag = $Pag . '
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(atual)</span></a>
                </li> 
                <li class="page-item"><a class="page-link" href="#">3</a></li>';
                

            }
            $Pag = $Pag . '<li class="page-item">
                <a class="page-link" href="#">Próximo</a>
            </li>
        </ul>
    </nav>
    ';
    return $Pag;
    */
}
