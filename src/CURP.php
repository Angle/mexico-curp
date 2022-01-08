<?php

namespace Angle\Mexico\CURP;

class CURP
{
    const REGEX = '/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/';

    public static function isValid(string $curp): bool
    {
        $r = preg_match(self::REGEX, $curp, $matches);

        if ($r === 1) {
            return true;
        }

        return false;
    }
}