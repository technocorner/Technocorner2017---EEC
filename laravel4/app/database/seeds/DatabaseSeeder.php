<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ParticipantTableSeeder');
		$this->command->info('Participant table seeded!');

		$this->call('AdminTableSeeder');
		$this->command->info('Admin table seeded!');

		$this->call('QTypeTableSeeder');
		$this->command->info('QType table seeded!');

		$this->call('QuestionTableSeeder');
		$this->command->info('Question table seeded!');
	}

}

class ParticipantTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		DB::table('users_participant')->delete();

		$now = Carbon::now();

		Participant::insert([
			'id' 					 => 1,
			'team_name'     => 'Technocorner Dummy Team 4EVER',
			// 'email'        => 'adhika.setyap@gmail.com',
			// 'password'     => Hash::make('1234'),

			'member_1'    => 'Dhika',
			'member_2'    => 'Roni',
			'member_3'    => 'Charlie',

			'school' => 'SMA N 3 Yogyakarta'
		]);
		Participant::create([
			'id' 					 => 2,
			'team_name'     => 'Another Dummy',
			// 'email'        => 'dummy@technocornerugm.com',
			// 'password'     => Hash::make('1234'),

			'member_1'    => 'Tion',
			'member_2'    => 'Budi',
			'member_3'    => 'Anggoro',

			'school' => 'SMA N 1 Bangka',
		]);

		$u = new User;
		$u->email = 'dhika_sp@yahoo.com';
		$u->password = Hash::make('1234');
		$u->save();

		$p = Participant::find(1);
		$p->user()->save($u);

		$u = new User;
		$u->email = 'dummy@technocornerugm.com';
		$u->password = Hash::make('1234');
		$u->save();

		$p = Participant::find(2);
		$p->user()->save($u);
	}
}

class AdminTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users_admin')->delete();

		$u = new User;
		$u->email = 'adhika.setyap@gmail.com';
		$u->password = Hash::make('1234');
		$u->save();

		$a = new Admin;
		$a->name = 'Adhika Setya Pramudita';
		$a->save();

		$a->user()->save($u);

    $u = new User;
		$u->email = 'abdillah96bu@gmail.com';
		$u->password = Hash::make('1234');
		$u->save();

		$a = new Admin;
		$a->name = 'Hernawan Fa\'iz Abdillah';
		$a->save();

		$a->user()->save($u);
    }
}

class QTypeTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('qtypes')->delete();

		$u = new QType;
		$u->name = 'Matematika';
		$u->save();

    $u = new QType;
		$u->name = 'Fisika';
		$u->save();

    $u = new QType;
		$u->name = 'Komputer';
		$u->save();
    }
}

class QuestionTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('questions')->delete();

		$now = Carbon::now();

		Question::insert([
			[
				'qtype_id' => 1,
				'question' => 'Berapakah 1 + 1?',
				'image'    => 'https://presbyterianblues.files.wordpress.com/2012/06/1-1-2.jpg',
				'chA'			 => '2',
				'chB'			 => '3',
				'chC'			 => '4',
				'chD'			 => '5',
				'chE'			 => '6',
				'randomize' => true,
				'answer'   => 'A',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'qtype_id' => 1,
				'question' => 'Berapakah 1 + 3?',
				'image'    => 'qimg-2.png',
				'chA'			 => '2',
				'chB'			 => '3',
				'chC'			 => '4',
				'chD'			 => '5',
				'chE'			 => '6',
				'randomize' => true,
				'answer'   => 'C',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'qtype_id' => 1,
				'question' => 'Berapakah 3 + 6?',
				'image'    => 'http://janbrett.com/images/addition_flash3+3=6.jpg',
				'chA'			 => '10',
				'chB'			 => '9',
				'chC'			 => '8',
				'chD'			 => '7',
				'chE'			 => '6',
				'randomize' => true,
				'answer'   => 'B',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'qtype_id' => 2,
				'question' => 'Air adalah salah satu contoh benda...',
				'image'    => 'http://lorempixel.com/300/200',
				'chA'			 => 'Padat',
				'chB'			 => 'Cair',
				'chC'			 => 'Gas',
				'chD'			 => 'Plasma',
				'chE'			 => 'Air? Aku mau es teh!',
				'randomize' => true,
				'answer'   => 'B',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'qtype_id' => 2,
				'question' => 'Bumi berbentuk menyerupai apa?',
				'image'    => '//lorempixel.com/300/200',
				'chA'			 => 'Pensil',
				'chB'			 => 'Lobak',
				'chC'			 => 'Persegi',
				'chD'			 => 'Bulat telur',
				'chE'			 => 'Kotak',
				'randomize' => true,
				'answer'   => 'D',
				'created_at' => $now,
				'updated_at' => $now
			],
			[
				'qtype_id' => 3,
				'question' => 'Web ini dibuat menggunakan framework apa?',
				'image'    => '//lorempixel.com/300/200',
				'chA'			 => 'Kembang api',
				'chB'			 => 'C++',
				'chC'			 => 'Kuda',
				'chD'			 => 'Pong',
				'chE'			 => 'Laravel',
				'randomize' => true,
				'answer'   => 'E',
				'created_at' => $now,
				'updated_at' => $now
			]
		]);

		$f = Faker\Factory::create();

    $j = 4;
		// 5 pseudo question above + 115 random question = 120 questions
		for ($i=0; $i < 115; $i++) {
			$randomAnswer = $f->randomElement(['A', 'B', 'C', 'D', 'E']);
            $qtype_rand = $f->numberBetween(1,3);
            $random_rand = $f->boolean();
            $hint = '';
            if ($qtype_rand == 1) {
                $hint .= '[ MTK urutan ' . $j . ' ]';
                $hint .= '[ Acak ? ' . var_export($random_rand, true) . ' ]';
                $j++;
            }
			Question::create([
				'qtype_id'   => $qtype_rand,
				'question'   => '__KUNCI : ' . $randomAnswer . "__ " . '[ qtype: ' . $qtype_rand .' ] ' . $hint . $f->text(25),
				'image'      => '//lorempixel.com/300/200',
				'chA'        => $f->word,
				'chB'        => $f->word,
				'chC'        => $f->word,
				'chD'        => $f->word,
				'chE'        => $f->word,
				'randomize'  => $random_rand,
				'answer'     => $randomAnswer,
				'created_at' => $now,
				'updated_at' => $now
			]);
		}
	}
}