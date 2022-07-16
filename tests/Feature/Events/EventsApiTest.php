<?php

namespace Tests\Feature\Events;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;
use Carbon\Carbon;

class EventsApiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_returns_json_events_list()
    {
        $knownDate = Carbon::create(2031, 5, 21, 12); 
        Carbon::setTestNow($knownDate);  
        
        Event::factory()->count(1)->state([
            'name'=>'Birthday',
            'budget' => 200,
            'date'=> Carbon::now()
        ])->create();
        
        $events = Event::all()->toArray();
        
        $response = $this->get('/events');
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'events' => $events
            ]);
    }
}
