<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Models\SampleTestTracking;
use App\Models\SampleTracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class SampleTestTrackingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SampleTestTracking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sample_tracking_id' => function () {
                return SampleTracking::factory()->create()->id;
            },
            'questionnaire_id' => function () {
                return Questionnaire::factory()->create()->id;
            },
        ];
    }
}
