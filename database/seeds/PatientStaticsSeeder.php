<?php

use App\Models\PatientStatistic;
use App\Models\RegistrationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PatientStaticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categorize = User::all()->groupBy(function($item){
            return ($item->registrationType) ? $item->registrationType->id : 24;
        })->map(function($row){
            return $row->count();
        });

        $regtype = RegistrationType::all();
        foreach ($regtype as $key => $value) {
            $data = array(
                'year' => Carbon::parse(date('Y')),
                'number' => 0,
                'registration_type_id' => $value->id
            );
            PatientStatistic::create($data);
        }

    }
}
