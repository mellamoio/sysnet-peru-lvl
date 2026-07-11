<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnico;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\EstadoEquipo;
use App\Models\TipoMovimiento;
use App\Models\Equipo;

class SysnetDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['nombre' => 'ADMIN'],
            ['nombre' => 'OPERADOR']
        ]);

        User::insert([
            [
                'rol_id' => 1,
                'name' => 'Administrador Sysnet',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'), // La contraseña se encripta aquí
                'estado' => true,
            ],
            [
                'rol_id' => 2,
                'name' => 'Operador Sysnet',
                'email' => 'operador@example.com',
                'password' => Hash::make('123456'), // La contraseña se encripta aquí
                'estado' => true,
            ],
        ]);

        // ... (Aquí está tu código anterior de Role y User) ...

        // 1. TÉCNICOS
        Tecnico::insert([
            ['nombre' => 'Juan Perez', 'dni' => '74125896', 'telefono' => '999111222'],
            ['nombre' => 'Carlos Diaz', 'dni' => '78451236', 'telefono' => '999222333'],
            ['nombre' => 'Miguel Ramos', 'dni' => '78541236', 'telefono' => '999333444'],
            ['nombre' => 'Luis Torres', 'dni' => '70236514', 'telefono' => '999444555'],
            ['nombre' => 'Jorge Castillo', 'dni' => '71852634', 'telefono' => '999555666'],
        ]);

        // 2. CLIENTES
        Cliente::insert([
            ['razon_social' => 'Transportes Lima SAC', 'ruc' => '20587412541', 'direccion' => 'Lima', 'telefono' => '999555111'],
            ['razon_social' => 'Minera Andina SAC', 'ruc' => '20654781254', 'direccion' => 'Arequipa', 'telefono' => '999555222'],
            ['razon_social' => 'AgroExport SAC', 'ruc' => '20478541236', 'direccion' => 'Ica', 'telefono' => '999555333'],
            ['razon_social' => 'Logistica Norte SAC', 'ruc' => '20547896521', 'direccion' => 'Trujillo', 'telefono' => '999555444'],
        ]);

        // 3. PROVEEDORES
        Proveedor::insert([
            ['razon_social' => 'Teltonika Peru', 'ruc' => '20698745125', 'telefono' => '999444111'],
            ['razon_social' => 'Hikvision Peru', 'ruc' => '20587412369', 'telefono' => '999444222'],
        ]);

        // 4. MARCAS Y MODELOS
        Marca::insert([
            ['nombre' => 'Teltonika'],
            ['nombre' => 'Hikvision'],
            ['nombre' => 'Queclink'],
            ['nombre' => 'Ruptela'],
        ]);

        Modelo::insert([
            ['marca_id' => 1, 'nombre' => 'FMB920'],
            ['marca_id' => 1, 'nombre' => 'FMB125'],
            ['marca_id' => 2, 'nombre' => 'DS-2CD1023'],
            ['marca_id' => 3, 'nombre' => 'GV300'],
            ['marca_id' => 4, 'nombre' => 'FM-Eco4'],
        ]);

        // 5. ESTADOS Y TIPOS DE MOVIMIENTO
        EstadoEquipo::insert([
            ['nombre' => 'Nuevo'],
            ['nombre' => 'Usado'],
            ['nombre' => 'Malogrado'],
        ]);

        TipoMovimiento::insert([
            ['nombre' => 'Compra Proveedor', 'operacion' => 'INGRESO'],
            ['nombre' => 'Retorno Alquiler', 'operacion' => 'INGRESO'],
            ['nombre' => 'Retorno Falla', 'operacion' => 'INGRESO'],
            ['nombre' => 'Devolucion Backup', 'operacion' => 'INGRESO'],
            ['nombre' => 'Venta', 'operacion' => 'SALIDA'],
            ['nombre' => 'Alquiler', 'operacion' => 'SALIDA'],
            ['nombre' => 'Garantia', 'operacion' => 'SALIDA'],
            ['nombre' => 'Backup', 'operacion' => 'SALIDA'],
        ]);

        // 6. EQUIPOS (Generando los 50 IMEIs de forma dinámica para no ensuciar el código)
        $equipos = [];

        // 10 Teltonika FMB920 (Nuevos)
        for ($i = 1; $i <= 10; $i++) {
            $equipos[] = ['imei' => '3520940832100' . str_pad($i, 2, '0', STR_PAD_LEFT), 'modelo_id' => 1, 'estado_id' => 1, 'disponible' => true];
        }
        // 10 Teltonika FMB125 (Nuevos)
        for ($i = 11; $i <= 20; $i++) {
            $equipos[] = ['imei' => '3520940832100' . str_pad($i, 2, '0', STR_PAD_LEFT), 'modelo_id' => 2, 'estado_id' => 1, 'disponible' => true];
        }
        // 10 Hikvision (Usados)
        for ($i = 21; $i <= 30; $i++) {
            $equipos[] = ['imei' => '3520940832100' . str_pad($i, 2, '0', STR_PAD_LEFT), 'modelo_id' => 3, 'estado_id' => 2, 'disponible' => true];
        }
        // 10 Queclink (Nuevos)
        for ($i = 31; $i <= 40; $i++) {
            $equipos[] = ['imei' => '3520940832100' . str_pad($i, 2, '0', STR_PAD_LEFT), 'modelo_id' => 4, 'estado_id' => 1, 'disponible' => true];
        }
        // 10 Ruptela (Malogrados - No disponibles)
        for ($i = 41; $i <= 50; $i++) {
            $equipos[] = ['imei' => '3520940832100' . str_pad($i, 2, '0', STR_PAD_LEFT), 'modelo_id' => 5, 'estado_id' => 3, 'disponible' => false];
        }

        Equipo::insert($equipos);
    }
}
