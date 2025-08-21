<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // first we will set a user_id and assign it to user
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            // paragraphs will take number of paragraph and 
            // if we want it to be text, then we will make true to 
            // the second argumnet
            'description' => $this->faker->paragraphs(2, true),
            // numberBetween will take two ranges
            'salary' => $this->faker->numberBetween(40000, 120000),
            // we will use words, because we want it to be comma 
            // sepertated list, so this words, will gonna take first
            // argument a number and it will give me the number of
            // element in array to that number, and if we enter second 
            // arugument to be true then it will give me 3 text, but as
            // we want them to be comma seperated so we can put it 
            // inside php implode function, which will turn this array 
            // into string, and the first argument we want this to be 
            // implode is the , and with a space as shown below.
            // so it will give me three words seperated by commas
            'tags' => implode(', ', $this->faker->words(3)),
            // since job_type is word by it is enum like full_time part_time
            // etc, so we will use randomElement() method, which will allow
            // us to add an array and put all the possible numbers that 
            // want, so we can add three of them and faker will pick one 
            // of those three randomeElements. 
            'job_type' => $this->faker->randomElement([
                    'Full-Time',
                    'Part-Time',
                    'Contract'
                ]
            ),
            'remote' => $this->faker->boolean(),
            // so for requirements, we will use sentences method with 
            // argument as 3 sentences and true [to make it text]
            'requirements' => $this->faker->sentences(3, true),
            'benefits' => $this->faker->sentences(2, true),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->postcode(),
            'contact_email' => $this->faker->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'company_description' => $this->faker->paragraphs(2, true),
            'company_logo' => $this->faker->imageUrl(100, 100, 'business', true, 'logo'),
            'company_website' => $this->faker->url()            
        ];
    }
}
