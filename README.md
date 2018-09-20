# Google2FA for Lumen

### Google Two-Factor Authentication Package for Lumen

Google2FA is a PHP implementation of the Google Two-Factor Authentication Module, supporting the HMAC-Based One-time Password (HOTP) algorithm specified in [RFC 4226](https://tools.ietf.org/html/rfc4226) and the Time-based One-time Password (TOTP) algorithm specified in [RFC 6238](https://tools.ietf.org/html/rfc6238).

This package is a Lumen update to  to [Google2FA for Laravel](https://packagist.org/packages/pragmarx/google2fa) package.

The intent of this package is to create a microservice safe way to implement 2FA Code and check responses against user.

### Recovery/Backup codes

if you need to create recovery or backup codes to provide a way for your users to recover a lost account, you can use the [Recovery Package](https://github.com/antonioribeiro/recovery). 

### Installation on Lumen
Add the Service Provider to your `bootstrap/app.php`

    Lshtmweb\Lumen2FA\TwoFactorServiceProvider::class
    
This package assumes you are using Dusterio passport for api authentication and have the standard oauth_tables. Feel free to change the migrations to suit your needs.

### Publish the config file and migrations
    php artisan vendor:publish --provider="Lshtmweb\Lumen2FA\TwoFactorServiceProvider::class"
    
### Usage
The standard routes have already been set up for you. You can change to suit your need by adding routes and pointing to the correct Controller methods.

- Add the middleware
  - In route middleware add a new middleware or use the default one `lumen2fa` to secure your routes.
### Events Fired
- TwoFactorActivatedEvent
- TwoFactorBeforeDisableEvent
- TwoFactorDisabledEvent
- TwoFactorInfoGeneratedEvent

### Using Laravel? Try this instead
[Google2FA for Laravel](https://packagist.org/packages/pragmarx/google2fa) 

### Changes
Pull requests are welcome