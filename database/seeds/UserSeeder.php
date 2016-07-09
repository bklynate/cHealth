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
            'username'         => 'neema001',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($receptionistRole);

        $user = User::create(array(
            'fullname'    => 'Valentine Mwangi',
            'username'         => 'neema002',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($doctorRole);

        $user = User::create(array(
            'fullname'    => 'Valentine Mwangi',
            'username'         => 'neema003',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($accountantRole);

        $user = User::create(array(
            'fullname'    => 'Valentine Mwangi',
            'username'         => 'neema004',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($pharmacyRole);

        $user = User::create(array(
            'fullname'    => 'Valentine Mwangi',
            'username'         => 'neema005',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($nurseRole);

        $user = User::create(array(
            'fullname'    => 'Valentine Mwangi',
            'username'         => 'neema006',
            'password'      => Hash::make('password')
        ));
        $user->assignRole($laboratoristRole);
    }
}
