<?php

namespace Angle\Mexico\CURP;

abstract class State
{

    // ISO Codes: ISO 3166/MX

    const AGUASCALIENTES        = 1;
    const BAJA_CALIFORNIA       = 2;
    const BAJA_CALIFORNIA_SUR   = 3;
    const CAMPECHE              = 4;
    const COAHUILA              = 5;
    const COLIMA                = 6;
    const CHIAPAS               = 7;
    const CHIHUAHUA             = 8;
    const CIUDAD_DE_MEXICO      = 9;
    const DURANGO               = 10;
    const GUANAJUATO            = 11;
    const GUERRERO              = 12;
    const HIDALGO               = 13;
    const JALISCO               = 14;
    const ESTADO_DE_MEXICO      = 15;
    const MICHOACAN             = 16;
    const MORELOS               = 17;
    const NAYARIT               = 18;
    const NUEVO_LEON            = 19;
    const OAXACA                = 20;
    const PUEBLA                = 21;
    const QUERETARO             = 22;
    const QUINTANA_ROO          = 23;
    const SAN_LUIS_POTOSI       = 24;
    const SINALOA               = 25;
    const SONORA                = 26;
    const TABASCO               = 27;
    const TAMAULIPAS            = 28;
    const TLAXCALA              = 29;
    const VERACRUZ              = 30;
    const YUCATAN               = 31;
    const ZACATECAS             = 32;

    const FOREIGN               = 99; // "Nacido en el Extranjero"

    protected static $map = [
        self::AGUASCALIENTES        => ['curp' => 'AS', 'iso' => 'AGU', 'name' => 'Aguascalientes'],
        self::BAJA_CALIFORNIA       => ['curp' => 'BC', 'iso' => 'BCN', 'name' => 'Baja California'],
        self::BAJA_CALIFORNIA_SUR   => ['curp' => 'BS', 'iso' => 'BCS', 'name' => 'Baja California Sur'],
        self::CAMPECHE              => ['curp' => 'CC', 'iso' => 'CAM', 'name' => 'Campeche'],
        self::COAHUILA              => ['curp' => 'CL', 'iso' => 'COA', 'name' => 'Coahuila de Zaragoza'],
        self::COLIMA                => ['curp' => 'CM', 'iso' => 'COL', 'name' => 'Colima'],
        self::CHIAPAS               => ['curp' => 'CS', 'iso' => 'CHP', 'name' => 'Chiapas'],
        self::CHIHUAHUA             => ['curp' => 'CH', 'iso' => 'CHH', 'name' => 'Chihuahua'],
        self::CIUDAD_DE_MEXICO      => ['curp' => 'DF', 'iso' => 'CMX', 'name' => 'Ciudad de México'], // Distrito Federal
        self::DURANGO               => ['curp' => 'DG', 'iso' => 'DUR', 'name' => 'Durango'],
        self::GUANAJUATO            => ['curp' => 'GT', 'iso' => 'GUA', 'name' => 'Guanajuato'],
        self::GUERRERO              => ['curp' => 'GR', 'iso' => 'GRO', 'name' => 'Guerrero'],
        self::HIDALGO               => ['curp' => 'HG', 'iso' => 'HID', 'name' => 'Hidalgo'],
        self::JALISCO               => ['curp' => 'JC', 'iso' => 'JAL', 'name' => 'Jalisco'],
        self::ESTADO_DE_MEXICO      => ['curp' => 'MC', 'iso' => 'MEX', 'name' => 'México'],
        self::MICHOACAN             => ['curp' => 'MN', 'iso' => 'MIC', 'name' => 'Michoacán de Ocampo'],
        self::MORELOS               => ['curp' => 'MS', 'iso' => 'MOR', 'name' => 'Morelos'],
        self::NAYARIT               => ['curp' => 'NT', 'iso' => 'NAY', 'name' => 'Nayarit'],
        self::NUEVO_LEON            => ['curp' => 'NL', 'iso' => 'NLE', 'name' => 'Nuevo León'],
        self::OAXACA                => ['curp' => 'OC', 'iso' => 'OAX', 'name' => 'Oaxaca'],
        self::PUEBLA                => ['curp' => 'PL', 'iso' => 'PUE', 'name' => 'Puebla'],
        self::QUERETARO             => ['curp' => 'QT', 'iso' => 'QUE', 'name' => 'Querétaro'],
        self::QUINTANA_ROO          => ['curp' => 'QR', 'iso' => 'ROO', 'name' => 'Quintana Roo'],
        self::SAN_LUIS_POTOSI       => ['curp' => 'SP', 'iso' => 'SLP', 'name' => 'San Luis Potosí'],
        self::SINALOA               => ['curp' => 'SL', 'iso' => 'SIN', 'name' => 'Sinaloa'],
        self::SONORA                => ['curp' => 'SR', 'iso' => 'SON', 'name' => 'Sonora'],
        self::TABASCO               => ['curp' => 'TC', 'iso' => 'TAB', 'name' => 'Tabasco'],
        self::TAMAULIPAS            => ['curp' => 'TS', 'iso' => 'TAM', 'name' => 'Tamaulipas'],
        self::TLAXCALA              => ['curp' => 'TL', 'iso' => 'TLA', 'name' => 'Tlaxcala'],
        self::VERACRUZ              => ['curp' => 'VZ', 'iso' => 'VER', 'name' => 'Veracruz de Ignacio de la Llave'],
        self::YUCATAN               => ['curp' => 'YN', 'iso' => 'YUC', 'name' => 'Yucatán'],
        self::ZACATECAS             => ['curp' => 'ZS', 'iso' => 'ZAC', 'name' => 'Zacatecas'],

        self::FOREIGN               => ['curp' => 'NE', 'iso' => null, 'name' => 'Nacido en el Extranjero'],
    ];

    public static function getName($id): ?string
    {
        if (!self::exists($id)) {
            return null;
        }

        return self::$map[$id]['name'];
    }

    public static function getIso($id): ?string
    {
        if (!self::exists($id)) {
            return null;
        }

        return self::$map[$id]['iso'];
    }

    public static function getIdFromCurp($curp): ?int
    {
        $curp = strtoupper($curp);
        $state = substr($curp, 11, 2);

        foreach (self::$map as $key => $props) {
            if ($props['curp'] == $state) {
                return $key;
            }
        }

        return null;
    }

    public static function getIsoFromCurp($curp): ?string
    {
        $id = self::getIdFromCurp($curp);

        if ($id !== null) {
            return self::getIso($id);
        }

        return null;
    }

    public static function exists($id): bool
    {
        return array_key_exists($id, self::$map);
    }
}