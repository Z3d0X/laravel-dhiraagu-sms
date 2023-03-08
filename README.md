## Installation

You can install the package via composer:

```bash
composer require zedox/laravel-dhiraagu-sms
```
<br />

## Configuration

Add the following in your `config/services.php`

```php
'dhiraagu-sms' => [
    'url' => env('DHIRAAGU_SMS_URL'),
    'userid' => env('DHIRAAGU_SMS_USERID'),
    'password' => env('DHIRAAGU_SMS_PASSWORD'),
],
```
then you can use the `.env` file to pass these credentials

```dotenv
DHIRAAGU_SMS_USERID=XXXXX
DHIRAAGU_SMS_PASSWORD=XXXXX
```

While url is optional, you must provide userid and password

<br />

## Usage

This service can easily be used using the Facade provided
```php
use Zedox\LaravelDhiraaguSms\Facades\DhiraaguSms;
```

You can use the send method which accepts a mobile no and a message
```php
    DhiraaguSms::send($toMobile, $message)
```

<br />

## Example


```php
Route::get('test-sms', function () {
    try {
        DhiraaguSms::send('9607XXXXXX', 'Hello World');
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
    return response()->json(['message' => 'Success: SMS sent']);
});
```
