# Application documentation

## Tech stack

- PHP 8.3
- Laravel 11
- Composer 2

## Software requirements

- MySQL 8
- Redis / Valkey
- Cron
- Supervisor / Systemd

## Required PHP extensions

- bcmath
- ctype
- fileinfo
- json
- mbstring
- openssl
- pdo
- tokenizer
- xml
- iconv
- pcre
- session
- simplexml
- curl
- dom
- filter
- libxml
- phar
- xmlwriter
- intl
- gd
- pcntl
- posix
- redis
- gmp
- uuid
- cli
- memcached
- amqp
- mongodb
- pgsql
- soap
- zip
- imagick
- imap
- mysql
- tidy
- exif

## Packages

| package                                            | description           |
| -------------------------------------------------- | --------------------- |
| https://github.com/premierstacks/php-stack.git     | Premierstacks PHP     |
| https://github.com/premierstacks/laravel-stack.git | Premierstacks Laravel |

## Tooling

| tool                                                    | description              |
| ------------------------------------------------------- | ------------------------ |
| https://github.com/premierstacks/php-cs-fixer-stack.git | Premierstacks PHPCSFixer |
| https://github.com/premierstacks/phpstan-stack.git      | Premierstacks PHPStan    |
| https://github.com/premierstacks/eslint-stack.git       | Premierstacks ESLint     |
| https://github.com/premierstacks/prettier-stack.git     | Premierstacks Prettier   |

## Locales

- en
- cs
- sk

## Cookies

| name                                                        | description        |
| ----------------------------------------------------------- | ------------------ |
| \_\_Host-session-${APP_NAME}-production-authorization-users | users bearer token |
| \_\_Host-session-${APP_NAME}-production                     | session            |

## Cron

### Scheduler

Run every minute to trigger background processes.

`* * * * * exec /provision/cron/scheduler.sh`

## Supervisor

### Default queue worker

Run in background to process background jobs.

`exec /provision/supervisor/queue_worker.sh`

## HTTP handling

Direct all HTTP requests to `/public/` folder first and fallback to `/public/index.php`.
