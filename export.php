<?php
/**
 * Copyright 2018 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
// [START sheets_quickstart]
require __DIR__ . '/vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig('credentials.json');
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
$spreadsheetId = 'YOUR_ID_HERE';

$range = "Sheet1!A1:D";

// Create the value range Object
$valueRange= new Google_Service_Sheets_ValueRange();

// You need to specify the values you insert
$valueRange->setValues(["values" => [$_POST['first_name'], $_POST['email_address'], $_POST['title'], $_POST['address']]]); // Add two values

// Then you need to add some configuration
$conf = ["valueInputOption" => "RAW", "insertDataOption" => "INSERT_ROWS"];

// Update the spreadsheet
if ($service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf)) {
  http_response_code(200);
} else {
  http_response_code(500);
}