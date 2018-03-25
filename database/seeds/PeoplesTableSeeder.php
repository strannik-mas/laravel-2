<?php

use Illuminate\Database\Seeder;

class PeoplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `peoples` (`name`, `position`, `images`, `text`) 
                    VALUES (?, ?, ?, ?)', [
            'Tom Rensed',
            'Chief Executive Officer',
            'team_pic1.jpg',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin consequat.',
        ]);
        DB::insert('INSERT INTO `peoples` (`name`, `position`, `images`, `text`) 
                    VALUES (?, ?, ?, ?)', [
            'Kathren Mory',
            'Vice President',
            'team_pic2.jpg',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin consequat.',
        ]);
        DB::insert('INSERT INTO `peoples` (`name`, `position`, `images`, `text`) 
                    VALUES (?, ?, ?, ?)', [
            'Lancer Jack',
            'Senior Manager',
            'team_pic3.jpg',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin consequat.',
        ]);
    }
}
