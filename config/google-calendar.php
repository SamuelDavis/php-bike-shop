<?php

return [

    /*
     * Path to the json file containing the credentials.
     */
    'service_account_credentials_json' => storage_path('app/google-calendar/service-account-credentials.json'),

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),
];

//'google' => [
//    'apiKey' => env('GAPI_API_KEY', '520475814257-4ml5dkkd3kkk9av5vtan9g39prro8vrp.apps.googleusercontent.com'),
//    'clientId' => env('GAPI_CLIENT_ID', 'AIzaSyCz7455u_mW-PQz8LfxGRmtYygDTVPobZQ'),
//    'calendarId' => env('GAPI_CALENDAR_ID', 'hva040762hhngg3nerqnfc5n2s@group.calendar.google.com')
//],
