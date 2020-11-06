<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PacienteTest extends TestCase
{
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testCreate(){
         $data = [
            'nombre_completo' => 'lorena mamani',
            'direccion' => 'avendia los tales',
            'ciudad' => 'cochabamba',
        ];
        // $response = $this->withHeaders([
        //     // 'Content-Type'=>'application/json',
        //     // 'Accept'=>'application/json',
        //     'Cache-Control'=>'no-cache',
        //     'Postman-Token'=>'<calculated when request is sent>',
        //     'Content-Type'=>'application/json',
        //     'Content-Length'=>'<calculated when request is sent>',
        //     'Host'=>'<calculated when request is sent>',
        //     'User-Agent'=>'PostmanRuntime/7.24.0',
        //     'Accept-Encoding'=>'gzip, deflate, br',
        //     'Connection'=>'keep-alive',
        //     'Accept'=>'application/json',
        // ]);

        // $this->withoutExceptionHandling();
        // $response =$this->postJson('api/pacientes', $data  );

        // $response
        //     ->assertStatus(201)
        //     ->assertJson([
        //         'created' => true,
        //     ]);



        $response = $this->get('/api/pacientes');

        $response->assertStatus(200);
        // $this->post('/api/pacientes', $data)
        //     ->assertStatus(201)
        //     ->assertJson($data);

    }
}
