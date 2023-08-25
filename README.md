# Vermont Auth

Out-of-the-box authentication against the LDAP server

## Installation

This is private repository. Before installation you have to set composer github-oath (see [authentication for private packages](https://getcomposer.org/doc/articles/authentication-for-private-packages.md#github-oauth) for more details)

```bash
composer config --global github-oauth.github.com [TOKEN]
```

Once you are done, add origin repository to the list of composer custom VCS

```json
"repositories": [
    {
        "type": "vcs",
        "url":  "https://github.com/vermontdevelopment/auth.git"
    }
]
```

Install package. For latest development version, require version **dev-master** which means the latest commit in the master branch.

```bash
composer require vermontdevelopment/auth
```

Publish package assets (migrations, config, routes, views, l18n).
Use flag `--tag=without-views` to omit Blade views.

```bash
php artisan vendor:publish 
php artisan vendor:publish --tag=without-views 
```

Run migrations, but be careful as this step will drop existing users table

```bash
php artisan migrate
```

## Configuration

Set environment variables within your project's .env file

```
LDAP_CONNECTIONS_PRIMARY_DN=
LDAP_CONNECTIONS_PRIMARY_PASSWORD=
LDAP_CONNECTIONS_PRIMARY_HOST=
LDAP_CONNECTIONS_PRIMARY_PORT=
LDAP_CONNECTIONS_PRIMARY_TLS=

LDAP_CONNECTIONS_SECONDARY_DN=
LDAP_CONNECTIONS_SECONDARY_PASSWORD=
LDAP_CONNECTIONS_SECONDARY_HOST=
LDAP_CONNECTIONS_SECONDARY_PORT=
LDAP_CONNECTIONS_SECONDARY_TLS=

LDAP_BASE_DN_USERS=
LDAP_OPT_PROTOCOL_VERSION=

HRMS_URL=
HRMS_KEY=
```

Set model of eloquent users provider in __config/auth.php__ to model `VermontDevelopment\Auth\Models\User` of this package.

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => VermontDevelopment\Auth\Models\User::class,
    ],
],
```

## Usage

After package being installed, use auth middleware on routes you want to be protected, like usually. Guest user is automatically redirected to `/login` page.
Works with intended page.

```php
Route::get('/', function () {
    return view('home');
})->middleware(['auth'])->name('home');
```

### Testing

``` bash
php artisan test
```
