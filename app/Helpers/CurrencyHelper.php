<?php



function getCurrencySymbol()
{
    return "$";
}

function formatNumber($number)
{
    //Format the amount with Spanish style
    return number_format($number, 2, ',', '.');
}

//convert spainish money format to base format
function deFormatAmount($amount){
    return str_replace(['.', ','], ['', '.'], $amount);
}

//convert base money format to spainish money format
function formatAmount($amount)
{
    //Format the amount with Spanish style
    return getCurrencySymbol() . formatNumber($amount);
}

function priceWithoutTax($price)
{
    $iva = 0.19;
    return round( $price / ( 1 + $iva ) , 2 );
}


function getTax( $price )
{
    return round( $price - priceWithoutTax( $price ) , 2 );
}

function subTotal( $price, $discount=0 ) {
    return round(  priceWithoutTax( $price ) - $discount, 2 );
}

function getIva( $price ) {
    $iva = 0.19;
    return round( $price * (1 - 1 / (1 + $iva)) , 2 );
}

function reduceReturnDiscount( $discount, $total_unit ) {
    return  ( $discount ) ? round( $discount / $total_unit ) : 0;
}

?>