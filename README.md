# Taktik Laravel Proof

## CLI

Available make commands:

```bash
# provision for local environment
make local

# provision for testing (CI) environment
make testing

# provision for development environment
make development

# provision for staging environment
make staging

# provision for production environment
make production

# start artisan dev server
make start / make serve / make server

# run automatic code fixers
make fix

# run linters, static analysis, tests and audit
make check

# browse phpunit code coverage
make coverage

# clean up the project
make clean
```

## How to provision

```bash
git clone Xxxx Yyyy

cd Yyyy

cp .env.local.example .env
cp .env.testing.example .env.testing

vim .env
vim .env.testing

make local check start
```

## Docs

- [Application Documentation](./docs/application_documentation.md)
- [Swagger Documentation](./public/docs/openapi.json)
