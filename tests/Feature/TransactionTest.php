<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{

    use RefreshDatabase;
    public $user;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
        $this->user=User::factory()->create();
        $this->actingAs($this->user);

    }

    public function test_can_send_money()
    {

        $this->withoutExceptionHandling();
        $receiver=User::factory()->create();
        $formData=['receiver_email'=>$receiver->email,"amount"=>200];
        $this->json('POST',route('transactions.send'),$formData)
              ->assertStatus(200)
        ;
    }


    public function test_can_deposit()
    {
        $this->withoutExceptionHandling();

        $formData=['amount'=>250];
        $formatResponse=[
            'message'=>''
        ];
        $this->json('POST',route('transactions.deposit'),$formData)
              ->assertStatus(200);

    }

    public function test_can_show_transactions()
    {
        $this->withoutExceptionHandling();
       $this->get(route('transactions.history'))
             ->assertStatus(200)
             ->assertJson(['recieved_transcactions'=>array(),'sendtransactions'=>array()]) ;

    }


}
