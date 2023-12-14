<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {

        $data = OrderItem::query()
            ->whereHas("product", function (Builder $query){
                $query->where("name", "پفک");
            })->orderByDesc("quantity")->limit(1)->first();


        dd($data);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
