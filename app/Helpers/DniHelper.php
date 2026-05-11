<?php

namespace App\Helpers;

/**
 * Verificació de DNI, NIE i CIF segons l'algoritme oficial espanyol.
 * Apartat 12 del projecte.
 */
class DniHelper
{
    private const LLETRES_DNI = 'TRWAGMYFPDXBNJZSQVHLCKE';

    /**
     * Verifica un DNI (8 dígits + 1 lletra) o un NIE (X/Y/Z + 7 dígits + 1 lletra).
     */
    public static function verificarDni(string $dni): bool
    {
        $dni = strtoupper(trim($dni));

        if (strlen($dni) !== 9) {
            return false;
        }

        // NIE: converteix la primera lletra en número
        if (preg_match('/^[XYZ]/', $dni)) {
            $dni = strtr($dni, ['X' => '0', 'Y' => '1', 'Z' => '2']);
        }

        // DNI: 8 dígits + 1 lletra
        if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            return false;
        }

        $numero = (int) substr($dni, 0, 8);
        $lletra = substr($dni, 8, 1);
        $lletraCalculada = self::LLETRES_DNI[$numero % 23];

        return $lletra === $lletraCalculada;
    }

    /**
     * Verifica un CIF (lletra + 7 dígits + dígit/lletra control).
     */
    public static function verificarCif(string $cif): bool
    {
        $cif = strtoupper(trim($cif));

        if (!preg_match('/^[ABCDEFGHJNPQRSUVW][0-9]{7}[0-9A-J]$/', $cif)) {
            return false;
        }

        $control = substr($cif, 8, 1);
        $numeros = substr($cif, 1, 7);
        $suma = 0;

        for ($i = 0; $i < 7; $i++) {
            $n = (int) $numeros[$i];
            if ($i % 2 === 0) {
                // Posicions parelles (0, 2, 4, 6): multiplicar per 2 i sumar dígits
                $n *= 2;
                $suma += ($n > 9) ? ($n - 9) : $n;
            } else {
                $suma += $n;
            }
        }

        $digitControl = (10 - ($suma % 10)) % 10;
        $lletresControl = 'JABCDEFGHI';
        $primera = $cif[0];

        // Segons la primera lletra, el control és número o lletra
        if (in_array($primera, ['A', 'B', 'E', 'H'])) {
            return $control === (string) $digitControl;
        } elseif (in_array($primera, ['K', 'P', 'Q', 'S'])) {
            return $control === $lletresControl[$digitControl];
        } else {
            return $control === (string) $digitControl || $control === $lletresControl[$digitControl];
        }
    }
}
