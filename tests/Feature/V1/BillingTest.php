<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\post;
use Faker\Factory as Faker;

describe('API/V1/BILLING', function () {

    it('200', function () {
        $csv_content = <<<CSV
            name,governmentId,email,debtAmount,debtDueDate,debtId
            John Doe,11111111111,johndoe@kanastra.com.br,1000000.00,2022-10-12,1adb6ccf-ff16-467f-bea7-5f05d494280f
            CSV;

        $file = UploadedFile::fake()->createWithContent(Faker::create()->name . '.csv', $csv_content);

        $response = post('/api/v1/billing', [
            'file' => $file,
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['Billings sends with success']);

        Storage::disk('local')->assertExists('billings/' . $file->hashName());
    });

    it('422', function () {
        $response = post('/api/v1/billing', [], [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(422);
    });
});
