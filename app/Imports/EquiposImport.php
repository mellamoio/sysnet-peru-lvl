<?php

namespace App\Imports;

use App\Models\Equipo;
use App\Models\Modelo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EquiposImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Prepara los datos ANTES de que pasen por las reglas de validación
     */
    public function prepareForValidation($data, $index)
    {
        if (isset($data['imei'])) {
            // Convierte notación científica (ej. 1.23457E+14) o números flotantes a texto plano limpio de 15 dígitos
            $data['imei'] = sprintf('%.0f', $data['imei']);
        }

        return $data;
    }

    public function model(array $row)
    {
        // Forzamos formato texto limpio
        $imei = sprintf('%.0f', $row['imei']);

        $valorModelo = $row['modelo'] ?? $row['modelo_id'] ?? null;

        $modeloId = is_numeric($valorModelo) 
            ? $valorModelo 
            : Modelo::where('nombre', trim($valorModelo))->value('id');

        return new Equipo([
            'imei'          => $imei,
            'modelo_id'     => $modeloId,
            'estado_id'     => $row['estado_id'],
            'disponible'    => $row['disponible'] ?? 1,
            'observaciones' => $row['observaciones'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.imei' => 'required|numeric|digits_between:14,18|unique:equipos,imei',
            
            '*.modelo' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('El campo modelo es obligatorio.');
                        return;
                    }
                    
                    $existe = is_numeric($value) 
                        ? Modelo::where('id', $value)->exists()
                        : Modelo::where('nombre', trim($value))->exists();

                    if (!$existe) {
                        $fail("El modelo '{$value}' no existe en el sistema.");
                    }
                },
            ],

            '*.estado_id'  => 'required|exists:estados_equipos,id',
            '*.disponible' => 'nullable|boolean',
        ];
    }
}