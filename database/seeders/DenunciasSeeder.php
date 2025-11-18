<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DenunciasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('denuncias')->insert([
            [
                'titulo' => 'Bache grande en la Av. Grau',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'Existe un bache profundo que afecta el tránsito y ya ha provocado daños en autos.',
                'ubicacion' => 'Av. Grau cuadra 7, frente a la botica “La Salud”.',
                'estado' => 'pendiente',
                'ciudadano' => 'Carlos Ramírez Torres',
                'telefono_ciudadano' => '945123678',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Falta de iluminación en parque',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'El parque central del barrio El Bosque se encuentra sin alumbrado público.',
                'ubicacion' => 'Parque Central, Urb. El Bosque.',
                'estado' => 'en proceso',
                'ciudadano' => 'María Alejandra Silva',
                'telefono_ciudadano' => '987456321',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Acumulación de basura en esquina',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'Los vecinos han reportado acumulación de basura por más de una semana.',
                'ubicacion' => 'Esq. de Jr. Lima con Jr. Callao.',
                'estado' => 'pendiente',
                'ciudadano' => 'José Luis Quispe',
                'telefono_ciudadano' => '956874321',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Parque infantil con juegos dañados',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'Los columpios están rotos y representan un peligro para los niños.',
                'ubicacion' => 'Parque Los Suspiros, Mz. C Lote 4.',
                'estado' => 'resuelto',
                'ciudadano' => 'Ana Paola Medina',
                'telefono_ciudadano' => '912365478',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Rejilla de desagüe hundida',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'La tapa metálica está suelta y genera riesgo para motociclistas.',
                'ubicacion' => 'Av. Perú con Av. Los Próceres.',
                'estado' => 'en proceso',
                'ciudadano' => 'Luis Enrique Gonzales',
                'telefono_ciudadano' => '998741236',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Arbusto caído bloqueando vereda',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'Un árbol ha caído bloqueando el paso peatonal.',
                'ubicacion' => 'Calle Las Gardenias 145.',
                'estado' => 'pendiente',
                'ciudadano' => 'Daniela Rojas Campos',
                'telefono_ciudadano' => '934567812',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Señal de tránsito deteriorada',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'La señal de pare está completamente doblada y no es visible.',
                'ubicacion' => 'Av. Los Incas con Psje. Los Olivos.',
                'estado' => 'pendiente',
                'ciudadano' => 'Fernando Aguilar',
                'telefono_ciudadano' => '987651234',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Rotura de tubería genera fuga de agua',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'Fuga constante durante todo el día afecta la presión del agua en la zona.',
                'ubicacion' => 'Jr. San Martín 230.',
                'estado' => 'resuelto',
                'ciudadano' => 'Rosa Villar Márquez',
                'telefono_ciudadano' => '923456781',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Ruidos molestos de local nocturno',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'El local “La Esquina” reproduce música fuerte hasta altas horas de la noche.',
                'ubicacion' => 'Av. Bolognesi 1020.',
                'estado' => 'en proceso',
                'ciudadano' => 'Javier Morales',
                'telefono_ciudadano' => '921564738',
                'fecha_registro' => now()
            ],
            [
                'titulo' => 'Contenedor de basura desbordado',
                'imagen' => 'storage/imagenes/denuncias.png',
                'descripcion' => 'El contenedor municipal está lleno y desprende malos olores.',
                'ubicacion' => 'Calle Unión, frente al coliseo cerrado.',
                'estado' => 'pendiente',
                'ciudadano' => 'Lucía Herrera Chiroque',
                'telefono_ciudadano' => '987463512',
                'fecha_registro' => now()
            ],
        ]);
    }
}
