<?php

namespace App\Libraries;

class DomicilioFiscalValidator
{
    /**
     * Devuelve el primer error fiscal encontrado, o null si los datos son válidos.
     */
    public function validate(array $data): ?string
    {
        $tipoPersona = (int) ($data['tipo_persona'] ?? 0);
        $rfc = strtoupper(trim((string) ($data['rfc'] ?? '')));

        if (!in_array($tipoPersona, [1, 2], true)) {
            return 'Selecciona el tipo de persona.';
        }

        if ($rfc === '') {
            return 'El RFC es obligatorio.';
        }

        $longitudEsperada = $tipoPersona === 2 ? 12 : 13;
        if (strlen($rfc) !== $longitudEsperada) {
            return $tipoPersona === 2
                ? 'El RFC de Persona Moral debe tener 12 caracteres.'
                : 'El RFC de Persona Física debe tener 13 caracteres.';
        }

        if ($tipoPersona === 2 && trim((string) ($data['razon_social'] ?? '')) === '') {
            return 'La razón social es obligatoria para Persona Moral.';
        }

        if ($tipoPersona === 1) {
            foreach (['nombres' => 'El nombre es obligatorio para Persona Física.', 'paterno' => 'El apellido paterno es obligatorio para Persona Física.'] as $field => $message) {
                if (trim((string) ($data[$field] ?? '')) === '') {
                    return $message;
                }
            }
        }

        foreach ([
            'calle' => 'calle',
            'numero' => 'número exterior',
            'colonia' => 'colonia',
            'municipio' => 'municipio o alcaldía',
            'estado' => 'estado',
            'codigo_postal' => 'código postal',
            'uso' => 'uso de CFDI',
        ] as $field => $label) {
            if (trim((string) ($data[$field] ?? '')) === '' || (in_array($field, ['estado', 'uso'], true) && (int) $data[$field] < 1)) {
                return 'El campo ' . $label . ' es obligatorio.';
            }
        }

        return null;
    }
}
