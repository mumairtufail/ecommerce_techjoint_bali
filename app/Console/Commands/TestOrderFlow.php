<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\OrderController;
use App\Services\BannerService;

class TestOrderFlow extends Command
{
    protected $signature = 'test:order-flow';
    protected $description = 'Test the order flow to ensure it works';

    public function handle()
    {
        $this->info('🧪 Testing Order Flow...');
        
        try {
            // Create a mock request with test data
            $testData = [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john.doe@test.com',
                'phone' => '+1234567890',
                'city' => 'New York',
                'state' => 'California',
                'address' => '123 Test Street',
                'order_items' => json_encode([
                    [
                        'id' => 3, // Using existing product ID
                        'name' => '0.70 Carat TW Round Brilliant Laboratory-Grown Diamond',
                        'price' => 2500.00,
                        'quantity' => 1
                    ]
                ]),
                'total' => 2500.00,
                'cardholder_name' => 'John Doe',
                'card_number' => '4111111111111111',
                'card_expiry' => '12/25',
                'card_cvc' => '123',
                'payment_method' => 'stripe'
            ];

            $this->info('📝 Test data prepared');
            
            // Create mock request
            $request = new Request();
            $request->replace($testData);
            
            $this->info('🔄 Creating controller instance...');
            
            // Instantiate controller with required dependency
            $bannerService = app(BannerService::class);
            $controller = new OrderController($bannerService);
            
            $this->info('✅ Controller created successfully');
            $this->info('🚀 Calling storeWebOrders method...');
            
            // Call the method
            $response = $controller->storeWebOrders($request);
            
            $this->info('✅ Method executed successfully!');
            $this->info('📄 Response type: ' . get_class($response));
            
            if (method_exists($response, 'getStatusCode')) {
                $this->info('📊 Status Code: ' . $response->getStatusCode());
            }
            
            $this->info('🎉 Order flow test completed successfully!');
            
        } catch (\Exception $e) {
            $this->error('❌ Test failed: ' . $e->getMessage());
            $this->error('📁 File: ' . $e->getFile());
            $this->error('📍 Line: ' . $e->getLine());
            $this->error('📋 Trace: ' . $e->getTraceAsString());
        }
    }
}
