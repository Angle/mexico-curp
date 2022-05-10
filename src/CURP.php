<?php

namespace Angle\Mexico\CURP;

use DateTime;

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

    public static function getBirthDate(string $curp): ?DateTime
    {
        if (!self::isValid($curp)) return null;

        $dateStr = substr($curp, 4, 6);
        $year = intval(substr($curp, 4, 2));

        if ($year < 20) {
            $century = '20'; // 2000 - 2020
        } else {
            $century = '19'; // 1921 - 1999
        }

        $date = DateTime::createFromFormat('Ymd', $century . $dateStr);

        if ($date === false) {
            return null;
        }

        // Reset the time component
        $date->setTime(0, 0, 0);

        return $date;
    }

    public static function getAge(string $curp, ?DateTime $now = null)
    {
        if ($now === null) {
            $now = new DateTime('now');
        }


    }

    public static function getStateIso(string $curp): ?string
    {
        if (!self::isValid($curp)) return null;

        return State::getIsoFromCurp($curp);
    }
}