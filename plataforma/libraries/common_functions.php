<?php
class Common_functions{

    function __construct(){
    }

    function subtotal(){
         $retencionestraslados   =  $this->sum_index($this->ImpuestosTraslados,'importe');
         $retencionesimpuestos   =  $this->sum_index($this->ImpuestosRetenciones,'importe');
         $RetencionesLocales   =  $this->sum_index($this->RetencionesLocales,'Importe');
         $TrasladosLocales   =  $this->sum_index($this->TrasladosLocales,'Importe');

         return (($this->ComprobanteInfo['subTotal']+($retencionestraslados - $retencionesimpuestos))); 

    }

    function detector()
     {
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $tablet = strpos($_SERVER['HTTP_USER_AGENT'],"tablet");
        $symbian = strpos($_SERVER['HTTP_USER_AGENT'],"symbian");
        $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"mobile");
        $phone = strpos($_SERVER['HTTP_USER_AGENT'],"phone");
        $pad = strpos($_SERVER['HTTP_USER_AGENT'],"pad");
        $iPad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $ios = strpos($_SERVER['HTTP_USER_AGENT'],"ios");

 
            if ($iphone || $android || $palmpre || $ipod || $berry || $tablet || $symbian || $mobile || $phone || $iPad || $ios == true)
            {
                return TRUE;
            }   
            else{
                return FALSE;
            }
    }

    function get_logo_url($image_path=null)
    {
        if(isset($image_path) && trim($image_path) != "" && !$this->is_url($image_path)){
            return base_url("images/".str_replace('./','', $image_path)) ;
        }
        return $image_path;

    }

    function sum_index($array,$index){
        $total_values = array();
        $total_values[$index]=0;

        if(is_array($array) && count($array) > 0 ){
            foreach ($array as $item=>$value) {
                if(is_array($value)){
                    $total_values[$index] += $value[$index];
                    $last = $value;
                }else{
                    if($index == $item) $total_values[$index] = $value;
                }

            } 
        }

        return $total_values[$index];
    }

    function array_compact( $array,$new_index = NULL)
    {
        $array= array($array);
        $new_array = array();
        $array = array_filter($array);
        if(is_array($array) && !empty($array)){
            foreach ($array as $key => $value)
            {
                
                if(empty($value)){
                    unset($array[$key]);
                }else{$array[$key] =array_filter($value);}

            }
        }
        $result = (count($array)> 0) ? array_pop(array_chunk($array,count($array))) : array();

        if(!is_null($new_index)){
            $new_array[$new_index] = array_pop($result); 
            
            return $new_array;
        }
        $result = @array_key_exists('0_attr', $result[0]) ? array_values(array_pop($result)) : $result;
        return $result; 
    }

    function buildOriginal(){
        $comprobante = $this->EmisorComplemento;
        unset($comprobante['xmlns:tfd']);
        unset($comprobante['xsi:schemaLocation']);
        unset($comprobante['selloSAT']);
        return "||".implode($comprobante,'|')."||";
    }

    function MoneyPositions( $amount_string, $pos=10 ){
        if(function_exists("money_format")){
            return money_format("%=0(#{$pos}.6n", $amount_string);
        }
    }

    function Mayus($string){
        return strtr(strtoupper($string),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
    }

    function setFormato($formato)
    {
        log_message('debug','Elegimos formato');

        return $this;
    }

   function build_key($key)
    {
        return $this->prefix.ucfirst($key);
    }

    function  find_attribute($object,$attribute_name,$prefix = null){

        if(is_null($prefix)) $prefix = $this->prefix;
        if(@array_key_exists("{$prefix}{$attribute_name}_attr",$object)){
            return $object["{$prefix}{$attribute_name}_attr"];
        }else{
            try{
                return @$object["{$prefix}{$attribute_name}"];
            }catch(Exception $e){
                return $e->getMessage();
            }
        } 
    }

    function setPrefix($new_prefix){
        $this->prefix = $new_prefix;
    }
    function sumar(){
        
    }

    function prepare($conceptos,$property= "Concepto", $prefix = null)
    {
        if(is_null($prefix)) $prefix=$this->prefix;
        $elements = Array();
        if(is_array($conceptos)){
        foreach($conceptos as $key=>$value){
            if($key == "{$prefix}{$property}" && count($value) > 0){
                foreach($value as $concepto_key => $concepto_value){
                    if(is_array($concepto_value) && count($concepto_value) > 0 ){
                        array_push($elements,$concepto_value);
                    }
                }
            }else{
                if($key == "{$prefix}{$property}_attr"){
                    array_push($elements,$value);
                }

            }

        }
        return $elements;
    }
    }

    function setBackgroundImage($image_path){
        log_message('debug','seteamos la imagen');
        $this->image= $image_path;
        return $this;
    }

    function today(){
        $days = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return  $days[date('w')]." ".date('d')." de ".$months[date('n')-1]. " del ".date('Y') ;
    }

    function generate_qr($url_origen,$archivo_destino){ 
        $mi_curl = curl_init ($url_origen); 
        $fs_archivo = fopen ($archivo_destino, "w"); 
        curl_setopt ($mi_curl, CURLOPT_FILE, $fs_archivo); 
        curl_setopt ($mi_curl, CURLOPT_HEADER, 0); 
        curl_exec ($mi_curl); 
        curl_close ($mi_curl); 
        fclose ($fs_archivo); 
    } 

    function money_to_string($num, $fem = false, $dec = true,$moneda = "MXN") {
        $monedas = array('MXN'=>"M.N.","USD"=>"U.S.D.");
        $divisas  = array('MXN'=>" pesos ", 'USD'=>" dólares ");
        $divisa = $divisas[$moneda];
        $moneda = $monedas[$moneda];
        $matuni[2]  = "dos";
        $matuni[3]  = "tres";
        $matuni[4]  = "cuatro";
        $matuni[5]  = "cinco";
        $matuni[6]  = "seis";
        $matuni[7]  = "siete";
        $matuni[8]  = "ocho";
        $matuni[9]  = "nueve";
        $matuni[10] = "diez";
        $matuni[11] = "once";
        $matuni[12] = "doce";
        $matuni[13] = "trece";
        $matuni[14] = "catorce";
        $matuni[15] = "quince";
        $matuni[16] = "dieciseis";
        $matuni[17] = "diecisiete";
        $matuni[18] = "dieciocho";
        $matuni[19] = "diecinueve";
        $matuni[20] = "veinte";
        $matunisub[2] = "dos";
        $matunisub[3] = "tres";
        $matunisub[4] = "cuatro";
        $matunisub[5] = "quin";
        $matunisub[6] = "seis";
        $matunisub[7] = "sete";
        $matunisub[8] = "ocho";
        $matunisub[9] = "nove";

        $matdec[2] = "veint";
        $matdec[3] = "treinta";
        $matdec[4] = "cuarenta";
        $matdec[5] = "cincuenta";
        $matdec[6] = "sesenta";
        $matdec[7] = "setenta";
        $matdec[8] = "ochenta";
        $matdec[9] = "noventa";
        $matsub[3]  = 'mill';
        $matsub[5]  = 'bill';
        $matsub[7]  = 'mill';
        $matsub[9]  = 'trill';
        $matsub[11] = 'mill';
        $matsub[13] = 'bill';
        $matsub[15] = 'mill';
        $matmil[4]  = 'millones';
        $matmil[6]  = 'billones';
        $matmil[7]  = 'de billones';
        $matmil[8]  = 'millones de billones';
        $matmil[10] = 'trillones';
        $matmil[11] = 'de trillones';
        $matmil[12] = 'millones de trillones';
        $matmil[13] = 'de trillones';
        $matmil[14] = 'billones de trillones';
        $matmil[15] = 'de billones de trillones';
        $matmil[16] = 'millones de billones de trillones';

        //Zi hack
        $float=explode('.',$num);
        $num=$float[0];

        $num = trim((string)@$num);
        if ($num[0] == '-') {
            $neg = 'menos ';
            $num = substr($num, 1);
        }else
            $neg = '';
        while ($num[0] == '0') $num = substr($num, 1);
        if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
        $zeros = true;
        $punt = false;
        $ent = '';
        $fra = '';
        for ($c = 0; $c < strlen($num); $c++) {
            $n = $num[$c];
            if (! (strpos(".,'''", $n) === false)) {
                if ($punt) break;
                else{
                    $punt = true;
                    continue;
                }

            }elseif (! (strpos('0123456789', $n) === false)) {
                if ($punt) {
                    if ($n != '0') $zeros = false;
                    $fra .= $n;
                }else

                    $ent .= $n;
            }else

                break;

        }
        $ent = '     ' . $ent;
        if ($dec and $fra and ! $zeros) {
            $fin = ' coma';
            for ($n = 0; $n < strlen($fra); $n++) {
                if (($s = $fra[$n]) == '0')
                    $fin .= ' cero';
                elseif ($s == '1')
                    $fin .= $fem ? ' una' : ' un';
                else
                    $fin .= ' ' . $matuni[$s];
            }
        }else
            $fin = '';
        if ((int)$ent === 0) return 'Cero ' . $fin;
        $tex = '';
        $sub = 0;
        $mils = 0;
        $neutro = false;
        while ( ($num = substr($ent, -3)) != '   ') {
            $ent = substr($ent, 0, -3);
            if (++$sub < 3 and $fem) {
                $matuni[1] = 'una';
                $subcent = 'as';
            }else{
                $matuni[1] = $neutro ? 'un' : 'uno';
                $subcent = 'os';
            }
            $t = '';
            $n2 = substr($num, 1);
            if ($n2 == '00') {
            }elseif ($n2 < 21)
                $t = ' ' . $matuni[(int)$n2];
            elseif ($n2 < 30) {
                $n3 = $num[2];
                if ($n3 != 0) $t = 'i' . $matuni[$n3];
                $n2 = $num[1];
                $t = ' ' . $matdec[$n2] . $t;
            }else{
                $n3 = $num[2];
                if ($n3 != 0) $t = ' y ' . $matuni[$n3];
                $n2 = $num[1];
                $t = ' ' . $matdec[$n2] . $t;
            }
            $n = $num[0];
            if ($n == 1) {
                $t = ' ciento' . $t;
            }elseif ($n == 5){
                $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
            }elseif ($n != 0){
                $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
            }
            if ($sub == 1) {
            }elseif (! isset($matsub[$sub])) {
                if ($num == 1) {
                    $t = ' mil';
                }elseif ($num > 1){
                    $t .= ' mil';
                }
            }elseif ($num == 1) {
                $t .= ' ' . $matsub[$sub] . '?n';
            }elseif ($num > 1){
                $t .= ' ' . $matsub[$sub] . 'ones';
            }
            if ($num == '000') $mils ++;
            elseif ($mils != 0) {
                if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
                $mils = 0;
            }
            $neutro = true;
            $tex = $t . $tex;
        }
        $tex = $neg . substr($tex, 1) . $fin;
        if(count($float) == 2){
         if(strlen($float[1]) == 0)
           return $end_num=ucfirst($tex).$divisa."00/100 $moneda";
            if(strlen($float[1]) !=0 )
              return $end_num=ucfirst($tex).$divisa.((strlen($float[1]) == 1)?$float[1]."0":$float[1])."/100 $moneda";
            return $end_num=ucfirst($tex).$divisa."00/100 $moneda";                               
         }else return $end_num=ucfirst($tex).$divisa."00/100 $moneda";

    }
    function print_data($object){
        echo "<pre>";
        print_r($object);
    }
    function is_url($string){ 
        return array_key_exists('scheme', parse_url($string));
    }
}

