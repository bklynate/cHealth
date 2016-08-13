<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $adminRole            = Role::whereName('administrator')->first();
        $receptionistRole     = Role::whereName('receptionist')->first();
        $doctorRole           = Role::whereName('doctor')->first();
        $accountantRole       = Role::whereName('accountant')->first();
        $pharmacyRole         = Role::whereName('pharmacy')->first();
        $nurseRole            = Role::whereName('nurse')->first();
        $laboratoristRole     = Role::whereName('laboratorist')->first();

        $user = User::create(array(
            'fullname'      => 'Valentine Mwangi',
            'username'      => 'reception',
            'staffId'       => '123456',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($receptionistRole);

        $user = User::create(array(
            'fullname'      => 'Valentine Mwangi',
            'username'      => 'doctor',
            'staffId'       => '123422',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($doctorRole);

        $user = User::create(array(
            'fullname'      => 'Valentine Mwangi',
            'username'      => 'accounts',
            'staffId'       => '333456',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($accountantRole);

        $user = User::create(array(
            'fullname'      => 'Valentine Mwangi',
            'username'      => 'pharmacy',
            'staffId'       => '223456',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($pharmacyRole);

        $user = User::create(array(
            'fullname'      => 'Valentine Mwangi',
            'username'      => 'outpatient',
            'staffId'       => '1233456',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($nurseRole);

        $user = User::create(array(
            'fullname'      => 'Valentine Mwangi',
            'username'      => 'laboratory',
            'staffId'       => '1234256',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($laboratoristRole);
    }
}