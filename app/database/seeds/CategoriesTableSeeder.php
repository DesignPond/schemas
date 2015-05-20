<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('categories')->truncate();

		$categories = array(
			array( 'titre' => 'Procédure civile')
		);

		// Uncomment the below to run the seeder
		DB::table('categories')->insert($categories);
	}

}
