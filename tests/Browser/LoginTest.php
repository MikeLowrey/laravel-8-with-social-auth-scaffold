<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use App\Models\User;
use Hash;

class LoginTest extends DuskTestCase
{
    #use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $user = User::create([
            'email' => 'taylor@laravel.com',
            'name' => 'Mike',
            'password' => Hash::make('password')            
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
        
        $user->delete();
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        $user = User::create([
            'email' => 'taylor@laravel.com',
            'name' => 'Mike',
            'password' => Hash::make('password')            
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/login');
        });        
        
        $user->delete();
    }    

}
