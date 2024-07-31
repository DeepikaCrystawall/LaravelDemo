<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    // public function testExample(): void
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/')
    //                 ->assertSee('Laravel');
    //     });
    // }

    public function testUserCanLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::factory()->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('Passw0rd'), // Use a known password for the test
            ]);

            $browser->visit('/login')
                    ->timeout(60) // Increase the timeout to 60 seconds
                    ->type('email', 'admin@admin.com')
                    ->type('password', 'Passw0rd')
                    ->press('Login')
                    ->assertPathIs('/dashboard') // Check the redirect URL after login
                    ->assertSee('Dashboard'); // Check that the dashboard page loads correctly
        });
    }

    /**
     * A failed login test.
     *
     * @return void
     */
    public function testUserCannotLoginWithInvalidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'invaliduser@example.com')
                    ->type('password', 'wrongpassword')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.'); // Check for error message
        });
    }
}
