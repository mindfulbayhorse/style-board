<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_can_be_created()
    {
        
        $this->assertDatabaseMissing('events', ['name' =>'birthday']);
        
        Event::factory()->count(1)
            ->state(['name'=>'birthday'])->create();
        
        $this->assertDatabaseHas('events', ['name' =>'birthday']);
    }
}
