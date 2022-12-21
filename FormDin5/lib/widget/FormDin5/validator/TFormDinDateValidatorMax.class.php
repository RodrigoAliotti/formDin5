<?php
/**
 * Date validation Max Date
 *
 * @version    1.0
 * @package    validator
 * @author     Reinaldo A. Barreto Jr
 */
class TFormDinDateValidatorMax extends TFieldValidator
{
    /**
     * Apresenta uma mensagem de erro se a data do campo é posterior a data Maxima limite
     * Funciona com campo Date ou Datetime independe da máscara
     * @param $label Label do campo
     * @param $value Valor do campo
     * @param $parameters aditional 0=>MaskDate (máscara campo Date ou DateTime), 1=>MaxLimitDate (data limite no mesmo formato da máscara)
     */
    public function validate($label, $value, $parameters = NULL)
    {
        if( !empty($value) ){
            $defaultMask = 'yyyy-mm-dd hh:ii';
            $maskDat = $parameters[0];
            $maxLimitDate = $parameters[1];

            $dateValue    = TDateTime::convertToMask($value, $maskDat, $defaultMask);
            $maxLimitDate = TDateTime::convertToMask($maxLimitDate, $maskDat, $defaultMask);

            $dateValue    = new DateTime($dateValue);
            $maxLimitDate = new DateTime($maxLimitDate);

            //$maxLimitDate older than $dateValue
            $interval = $dateValue->diff($maxLimitDate); //If Date is in past then invert will 1
            if($interval->invert == 1){
                throw new InvalidArgumentException("O campo $label recebeu $value e não pode ser posterior a data $parameters[1]");
            }
        }
    }
}
?>
