<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InforUserOrder;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('InforUserOrder', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('phoneNumber');
            $table->string('email')->nullable()->default('example@gmail');
            $table->boolean('isUserCRM')->default('0');
            $table->string('text')->nullable();
            $table->integer('number')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->string('dropDown')->nullable();
            $table->string('checkBox')->nullable();
            $table->string('email2')->nullable()->default('example2@gmail');
        });

        $data = [
            [
                'name' => 'Jane Doe',
                'phoneNumber' => 9876543210,
                'email' => 'jane@example.com',
                'isUserCRM' => 0,
                'text' => 'This is some text',
                'number' => 200,
                'dropDown' => 'Option 1',
                'checkBox' => 'Checked',
                'email2' => 'jane2@example.com'
            ],
            [
                'name' => 'Bob Smith',
                'phoneNumber' => 5551234567,
                'email' => 'bob@example.com',
                'isUserCRM' => 0,
                'text' => 'This is more text',
                'number' => 150,
                'dropDown' => 'Option 2',
                'checkBox' => 'Unchecked',
                'email2' => 'bob2@example.com'
            ],
            [
                'name' => 'Alice Johnson',
                'phoneNumber' => 1112223333,
                'email' => 'alice@example.com',
                'isUserCRM' => 0,
                'text' => 'This is some additional text',
                'number' => 75,
                'dropDown' => 'Option 3',
                'checkBox' => 'Checked',
                'email2' => 'alice2@example.com'
            ],
            [
                'name' => 'Tom Wilson',
                'phoneNumber' => 4445556666,
                'email' => 'tom@example.com',
                'isUserCRM' => 1,
                'text' => 'This is more data',
                'number' => 300,
                'dropDown' => 'Option 4',
                'checkBox' => 'Unchecked',
                'email2' => 'tom2@example.com'
            ],
            [
                'name' => 'Sarah Davis',
                'phoneNumber' => 7778889999,
                'email' => 'sarah@example.com',
                'isUserCRM' => 1,
                'text' => 'This is the final data point',
                'number' => 125,
                'dropDown' => 'Option 5',
                'checkBox' => 'Checked',
                'email2' => 'sarah2@example.com'
            ]
        ];

        foreach ($data as $item) {
            $inforUserOrder = new InforUserOrder();
            $inforUserOrder->name = $item['name'];
            $inforUserOrder->phoneNumber = $item['phoneNumber'];
            $inforUserOrder->email = $item['email'];
            $inforUserOrder->isUserCRM = $item['isUserCRM'];
            $inforUserOrder->text = $item['text'];
            $inforUserOrder->number = $item['number'];
            $inforUserOrder->dropDown = $item['dropDown'];
            $inforUserOrder->checkBox = $item['checkBox'];
            $inforUserOrder->email2 = $item['email2'];
            $inforUserOrder->save();
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('InforUserOrder');
    }
};
