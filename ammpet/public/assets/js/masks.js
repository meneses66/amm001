$(document).ready(function(){
    /** 
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.percent').mask('##0,00%', {reverse: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    */

    $('#mobile_1').mask('(00) 00000-0000');
    $('#mobile_2').mask('(00) 00000-0000');
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#price').mask("#,##0.00", {reverse: true});
    $('#price_pix').mask("#,##0.00", {reverse: true});
    $('#price_cash').mask("#,##0.00", {reverse: true});
    $('#comission_percentage').mask("#,##0.00", {reverse: true});
    $('#external_cost').mask("#,##0.00", {reverse: true});
    $('#package_price').mask("#,##0.00", {reverse: true});
    //$('#unit_value').mask("#,##0.00", {reverse: true});
    //$('#discount_value').mask("#,##0.00", {reverse: true});
    //$('#price_pix').mask("#,##0.00", {reverse: true});
    //$('#price_cash').mask("#,##0.00", {reverse: true});
    $('#total_pix').mask("#.##0,00", {reverse: true});
    $('#total_cash').mask("#,##0.00", {reverse: true});
    $('#order_value_with_discount').mask("#,##0.00", {reverse: true});
    $('#order_value_no_discount').mask("#,##0.00", {reverse: true});
    $('#order_value_cash').mask("#,##0.00", {reverse: true});
    $('#order_value_pix').mask("#,##0.00", {reverse: true});
    $('#order_paid_amount').mask("#,##0.00", {reverse: true});
    $('#order_debt').mask("#,##0.00", {reverse: true});
    
  });
  