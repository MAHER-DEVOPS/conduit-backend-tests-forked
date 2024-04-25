<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testGetRouteKeyName()
    {
        $user = new User();
        $routeKeyName = $user->getRouteKeyName();

        $this->assertEquals('username', $routeKeyName);
    }

    public function testSetPasswordAttribute()
    {
        $user = new User();
        $plainPassword = 'password123';
        $user->password = $plainPassword;

        // Assert that the password attribute is hashed
        $this->assertNotEquals($plainPassword, $user->password);
    }
}
/**The testGetRouteKeyName function checks if the getRouteKeyName 
 * method of the User class correctly returns the route key name, which is supposed to be "username".
The testSetPasswordAttribute function tests if the setPasswordAttribute mutator 
function of the User class correctly hashes the password before storing it in the database */