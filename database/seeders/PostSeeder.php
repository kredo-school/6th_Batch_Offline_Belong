<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Post::insert([
            [
                'category_id' => 1,
                'title' => 'post 1',
                'date' => '2022-01-01',
                'reservation_due_date' => '2022-01-01',
                'place' => 'place 1',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 1',
                'image' => 'post1.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 2',
                'date' => '2022-01-02',
                'reservation_due_date' => '2022-01-02',
                'place' => 'place 2',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 2',
                'image' => 'post2.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 3',
                'date' => '2022-01-03',
                'reservation_due_date' => '2022-01-03',
                'place' => 'place 3',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 3',
                'image' => 'post3.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 4',
                'date' => '2022-01-04',
                'reservation_due_date' => '2022-01-04',
                'place' => 'place 4',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 4',
                'image' => 'post4.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 5',
                'date' => '2022-01-05',
                'reservation_due_date' => '2022-01-05',
                'place' => 'place 5',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 5',
                'image' => 'post5.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 6',
                'date' => '2022-01-06',
                'reservation_due_date' => '2022-01-06',
                'place' => 'place 6',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 6',
                'image' => 'post6.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 7',
                'date' => '2022-01-07',
                'reservation_due_date' => '2022-01-07',
                'place' => 'place 7',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 7',
                'image' => 'post7.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 8',
                'date' => '2022-01-08',
                'reservation_due_date' => '2022-01-08',
                'place' => 'place 8',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 8',
                'image' => 'post8.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 9',
                'date' => '2022-01-09',
                'reservation_due_date' => '2022-01-09',
                'place' => 'place 9',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 9',
                'image' => 'post9.jpg',
                'user_id' => 1,
            ],
            [
                'category_id' => 1,
                'title' => 'post 10',
                'date' => '2022-01-10',
                'reservation_due_date' => '2022-01-10',
                'place' => 'place 10',
                'planned_number_of_people' => 5,
                'participation_fee' => 1000,
                'description' => 'description 10',
                'image' => 'post10.jpg',
                'user_id' => 1,
            ],
        ]);


    }
}
