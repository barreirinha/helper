<?php
/**
 * Created by PhpStorm.
 * User: barreira
 * Date: 22/11/16
 * Time: 22:15
 */

/**
 * Translates a camel case string into a string with
 * underscores (e.g. firstName -> first_name)
 *
 * @param string $str String in camel case format
 * @return string $str Translated into underscore format
 */
function from_camel_case($str) {
    $str[0] = strtolower($str[0]);
    //$func = create_function('$c', 'return "_" . strtolower($c[1]);');

    $func = function ($c){
        return "_" . strtolower($c[1]);
    };

    return preg_replace_callback('/([A-Z])/', $func, $str);
}

/**
 * Translates a string with underscores
 * into camel case (e.g. first_name -> firstName)
 *
 * @param string $str String in underscore format
 * @param bool $capitalise_first_char If true, capitalise the first char in $str
 * @return string $str translated into camel caps
 */
function to_camel_case($str, $capitalise_first_char = false) {
    if($capitalise_first_char) {
        $str[0] = strtoupper($str[0]);
    }

    //$func = create_function('$c', 'return strtoupper($c[1]);');

    $func = function ($c){
        return strtoupper($c[1]);
    };

    return preg_replace_callback('/_([a-z])/', $func, $str);
}

function toCamelCase($input, $separator = ' ')
{
    return str_replace($separator, '', ucwords(strtolower($input)));
}

function formatarCNPJ($cnpj_){
    $cnpj = str_pad( cnpjToInt($cnpj_), 14, '0', STR_PAD_LEFT);
    return substr($cnpj,0,2).'.'.substr($cnpj,2,3).'.'.substr($cnpj,5,3).'/'.substr($cnpj,8,4).'-'.substr($cnpj,12,2);
}

function formatarCPF($cpf_)
{
    $cpf = str_pad( cpfToInt($cpf_), 11, '0', STR_PAD_LEFT);
    return substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
}

function cnpjToInt($cnpj)
{
    return ceil(str_replace(['.','/','-'],'',$cnpj));
}

function cpfOculto($cpf_)
{
    $cpf = str_pad( cpfToInt($cpf_), 11, '0', STR_PAD_LEFT);
    return substr($cpf,0,3).'.XXX.XXX'.'-'.substr($cpf,9,2);
}

function cpfPad($cpf_)
{
    return str_pad( cpfToInt($cpf_), 11, '0', STR_PAD_LEFT);
}

function cpfToInt($cpf_)
{
    return ceil(str_replace(['.','-'],'',$cpf_));
}

function dataBR($data)
{
    return implode('/', array_reverse(explode('-', $data)));
}

function DataURI($url, $tamanho_x = 0, $tamanho_y = 0){

    $image = Intervention\Image\ImageManagerStatic::make(public_path().$url);

    if($tamanho_x > 0 and $tamanho_y > 0){
        $image->resize($tamanho_x, $tamanho_y);
    }

    return $image->encode('data-url');

}

function dataSQL($data)
{
    return implode('-', array_reverse(explode('/', $data)));
}

function doisDigitos($n){
    return number_format($n,2,',','.');
}

function tirarAcentos($string){
    //strtoupper(preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $Loja->nome ) ));
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
}

function mesCurto($mes){
    $listaMeses = [
        1 => "Jan",
        2 => "Fev",
        3 => "Mar",
        4 => "Abr",
        5 => "Mai",
        6 => "Jun",
        7 => "Jul",
        8 => "Ago",
        9 => "Set",
        10 => "Out",
        11 => "Nov",
        12 => "Dez"
    ];

    return $listaMeses[(int) ceil($mes)];
}

function mesLongo($mes){
    $listaMeses = [
        1 => "Janeiro",
        2 => "Fevereiro",
        3 => "Março",
        4 => "Abril",
        5 => "Maio",
        6 => "Junho",
        7 => "Julho",
        8 => "Agosto",
        9 => "Setembro",
        10 => "Outubro",
        11 => "Novembro",
        12 => "Dezembro"
    ];

    return $listaMeses[(int) ceil($mes)];
}

function pad($numero,$digitos)
{
    return str_pad( $numero, $digitos, '0', STR_PAD_LEFT);
}

function semanaCurto($dia){
    $listaDias = [
        1 => "Dom",
        2 => "Seg",
        3 => "Ter",
        4 => "Qua",
        5 => "Qui",
        6 => "Sex",
        7 => "Sab"
    ];

    return $listaDias[(int) ceil($dia)];
}

function semanaLongo($dia){
    $listaDias = [
        1 => "Domingo",
        2 => "Segunda-Feira",
        3 => "Terça-Feira",
        4 => "Quarta-Feira",
        5 => "Quinta-Feira",
        6 => "Sexta-Feira",
        7 => "Sábado"
    ];

    $key = (int) ceil($dia);

    return $listaDias[$key];
}

function formatFileSize($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2,',','.') . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2,',','.') . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2,',','.') . ' kB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function ofuscarEmail($email)
{
    $em   = explode("@",$email);
    $name = implode(array_slice($em, 0, count($em)-1), '@');
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);

}

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

/**
 *
 */
function TimeElapsed($secs){
    $bit = array(
        ' ano'  => $secs / 31556926 % 12,
        ' sem'  => $secs / 604800 % 52,
        ' dia'  => $secs / 86400 % 7,
        ' h'    => $secs / 3600 % 24,
        ' min'  => $secs / 60 % 60,
        ' seg'  => $secs % 60
    );

    $ret = [];

    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
    }
    array_splice($ret, count($ret)-1, 0, 'e');
    // $ret[] = 'ago.';

    return join(' ', $ret);
}

function validarData($date)
{
    $d = \DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

function validaCNPJ($cnpj)
{
    $cnpj = str_pad( cnpjToInt($cnpj), 14, '0', STR_PAD_LEFT);

    // Valida tamanho
    if (strlen($cnpj) != 14 or $cnpj == '00000000000000') {
        return false;
    }

    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
    {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
    {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

function validaCPF($cpf)
{
    // Retira as Máscaras, se houver
    //$cpf = str_replace(['.','-',','],'',$cpf);

    // Verifiva se o número digitado contém todos os digitos
    $cpf = str_pad(preg_replace("/[^0-9]/", '', $cpf), 11, '0', STR_PAD_LEFT);
    //$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
    {
        return false;
    }

    // Calcula os números para verificar se o cpf é verdadeiro
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }

        $d = ((10 * $d) % 11) % 10;

        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}

/**
 * Coloca Null caso o valor seja em branco ('')
 *
 * @param string $value
 * @return int $value
 */
function setNullIfInt($value)
{
    if ($value > 0){
        return $value;
    }
    return null;
}

/**
 * Coloca Null caso o valor seja em branco ('') ou zero (0)
 *
 * @param string $value
 * @return int $value
 */
function setNullIfBlancOrZero($value)
{
    if (strlen($value) > 0 and $value != '0' and $value != 0){
        return $value;
    }
    return null;
}

/**
 * Subistitui os valores Brancos ("") ou zero (0) para null
 *
 * @param array $array_from 
 * @param array $array_to 
 * @param array $itens 
 * @return array $array_to
 */
function setIfExists(array $array_from, array $array_to, array $itens)
{
    foreach ($itens as $iten) {
        if (isset($array_from[$iten])){
            $array_to[$iten] = setNullIfBlancOrZero($array_from[$iten]);
        }
    }
    return $array_to;
}

