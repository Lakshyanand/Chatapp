<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Userdetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;



class loginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post('/login');
        $response->assertStatus(405);
    }

    public function test_visiting_admin_panel_without_logging_in()
    {
        $response = $this->withSession(['role' => null])->get('/adminpanel');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_user_can_view_loginpage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_cannot_view_a_login_form_when_logged_in()
    {
        $response = $this->withSession(['role' => 'Agent'])->get('/login');
        $response->assertRedirect('/agentpanel');
    }

    public function test_users_with_right_credentials()
    {
        $data = [
            'email' => 'lakshya.anand@ladybirdweb.com',
            'password' => '2222'
        ]; 
        $response = $this->post('/checkuser', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/agentpanel');
    
    }

    public function test_logging_in_with_wrong_email()
    {
        $response = $this->post('/checkuser',[
            'email' => 'harryy@ladybirdweb.com',
            'password' => '2222'
        ]);
        $response->assertSee('Email does not exist', $escaped = true);           
    }

    public function test_logging_in_with_wrong_password()
    {
        $response = $this->post('/checkuser',[
            'email' => 'lakshya.anand@ladybirdweb.com',
            'password' => 'vjfvkfmv',
        ]);
        $response->assertSee('Incorrect Password', $escaped = true);           
    }

    public function test_a_user_can_not_login_without_credentials()
    {
        $response = $this->post('/checkuser',[
            'email' => '',
            'password' => '',
        ]);
        $response->assertInvalid(['password', 'email']);
        $response->assertStatus(302);

    }

    // public function test_admin_can_add_a_agent()
    // {
    //     $data = [
    //         'email' => 'gagan.deep@ladybirdweb.com',
    //         'Name' => 'Gagan',
    //     ];

    //     $response = $this->withSession(['role' => 'Admin'])->post('/addagent',$data);
    //     $response->assertStatus(302);
    //     $response->assertRedirect('/adminpanel');
    //     $response->assertDatabaseHas('userdetails',$data);
    // }

}
