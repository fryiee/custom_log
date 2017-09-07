# custom_log ![Travis CI Build](https://travis-ci.org/fryiee/custom_log.svg?branch=master "Travis CI Builder")
A custom Log class based on Monolog's Logger.

## Installation
`composer require fryiee/custom_log`

Add `LOG_LOCATION` to your .env.

The package assumes the following:

- `LOG_LOCATION=laravel` will assume the same storage location as the `Log` facade
using `storage_path('logs')`
- `LOG_LOCATION=some/path/` will use that path to store logs. e.g. `./custom_logs`
- `LOG_LOCATION=` will default to the packages' own location of `fryiee/custom_log/logs`

## Usage
```
use Fryiee\CustomLog\Log;

...

Log::info('name', 'message');
```

The logger uses  the name to generate the log file. You can also use slashes to set a nested location:

```
Log::info('nested/name', 'message'); // creates a file at logs/nested/name.log
```
