<?php

namespace Drupal\nhsc_custom_brazil;

/**
 * Class ValidateService.
 */
class ValidateService
{

    /**
     * Constructs a new ValidateService object.
     */
    public function __construct()
    {

    }

    /**
     * Validate CPF number.
     *
     * Based on geekcom/validator-docs.
     */
    public function cpf($value)
    {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value)) {
            return FALSE;
        }

        $number = preg_replace('/\D/', '', $value);

        if (strlen($number) != 11 || preg_match("/^{$number[0]}{11}$/", $number)) {
            return FALSE;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $number[$i++] * $s--) ;

        if ($number[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return FALSE;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $number[$i++] * $s--) ;

        if ($number[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Validate CNPJ number.
     *
     * Based on geekcom/validator-docs.
     */
    public function cnpj($value)
    {
        if (!preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value)) {
            return FALSE;
        }

        $number = preg_replace('/\D/', '', $value);
        if (strlen($number) != 14 || preg_match("/^{$number[0]}{14}$/", $number)) {
            return FALSE;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0, $n = 0; $i < 12; $n += $number[$i] * $b[++$i]) ;

        if ($number[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return FALSE;
        }

        for ($i = 0, $n = 0; $i <= 12; $n += $number[$i] * $b[$i++]) ;

        if ($number[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Validate password strength.
     */
    public function password($value)
    {

        // Length is greater than 8 characters.
        if (strlen($value) < 8) {
            return FALSE;
        }

        // Length is less than 10 characters.
        if (strlen($value) > 10) {
            return FALSE;
        }

        // Contains one lowercase character.
        if (preg_match_all('/[a-z]/', $value) < 1) {
            return FALSE;
        }

        // Contains one uppercase character.
        if (preg_match_all('/[A-Z]/', $value) < 1) {
            return FALSE;
        }

        // Contains one number.
        if (preg_match_all('/\\d/', $value) < 1) {
            return FALSE;
        }

        // Contains one special character.
        if (preg_match_all('/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/', $value) < 1) {
            return FALSE;
        }

        return TRUE;
    }

}
