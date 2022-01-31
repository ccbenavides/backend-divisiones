<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        // \App\Models\User::factory(10)->create();
        $div_1 = $this->createDivision('Accionistas', $faker->name);
        $div_2 = $this->createDivision('Junta Directiva', $faker->name, $div_1->id);
        $div_3 = $this->createDivision('Dirección General', $faker->name, $div_2->id);
        $div_4 = $this->createDivision('Producción', $faker->name, $div_3->id);
        $div_5 = $this->createDivision('Planificación de producción', $faker->name, $div_4->id);
        $div_6 = $this->createDivision('Diseño Técnico/Industrial', $faker->name, $div_4->id);
        $div_7 = $this->createDivision('Aseguramiento de Calidad', $faker->name, $div_4->id);
        $div_8 = $this->createDivision('Mantenimiento', $faker->name, $div_4->id);
        $div_9 = $this->createDivision('Inversiones', $faker->name, $div_3->id);
        $div_10 = $this->createDivision('Investigación', $faker->name, $div_9->id);
        $div_11 = $this->createDivision('Planeación', $faker->name, $div_9->id);
        $div_12 = $this->createDivision('Ingeniería', $faker->name, $div_9->id);
        $div_13 = $this->createDivision('Mercadeo', $faker->name, $div_9->id);
        $div_14 = $this->createDivision('Promociones', $faker->name, $div_9->id);

        $div_15 = $this->createDivision('Medios', $faker->name, $div_3->id);
        $div_16 = $this->createDivision('Creativo de Marca', $faker->name, $div_15->id);
        $div_17 = $this->createDivision('Publicidad', $faker->name, $div_15->id);
        $div_18 = $this->createDivision('Relaciones Públicas', $faker->name, $div_15->id);
        $div_19 = $this->createDivision('Analisis del Mercado', $faker->name, $div_15->id);
        $div_20 = $this->createDivision('Mercadeo de Negocios', $faker->name, $div_15->id);

        $div_21 = $this->createDivision('División Técnica', $faker->name,$div_3->id);
        $div_22 = $this->createDivision('Diseño de Producto', $faker->name,$div_21->id);
        $div_23 = $this->createDivision('Desarrollo', $faker->name,$div_21->id);
        $div_24 = $this->createDivision('Auditoría', $faker->name,$div_21->id);
        $div_25 = $this->createDivision('Servicio Técnico', $faker->name,$div_21->id);
        $div_26 = $this->createDivision('Servicio al Cliente', $faker->name,$div_21->id);

        $div_27 = $this->createDivision('Recursos Humanos', $faker->name,$div_3->id);
        $div_28 = $this->createDivision('Grupo de Entrenamiento', $faker->name, $div_27->id);
        $div_29 = $this->createDivision('Oficina de Apoyo', $faker->name, $div_27->id);
        $div_30 = $this->createDivision('Compensación y Beneficios', $faker->name, $div_27->id);
   
    }

    public function createDivision($name, $ambassador, $upper_division = null) {
        return \App\Models\Division::create([
            'name' => $name,
            'upper_division' => $upper_division,
            'ambassador' => $ambassador,
            'count_collaborators' => rand(1,10)
        ]);
    }
}
