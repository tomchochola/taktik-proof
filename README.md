# [Laravel App Template](https://github.com/premierstacks/laravel-app-template) by [Tomáš Chochola](https://github.com/tomchochola)

✨ _**Clone and Win!**_

The Laravel App Template by Premierstacks is the ultimate foundation for Laravel development, combining a secure, modular setup with advanced session handling, multi-language support, and pre-configured tools. Designed for performance and scalability, it offers extensive customization while maintaining high-quality standards for production readiness.

## What is Laravel App Template?

The Laravel App Template is Premierstacks’ flagship offering, meticulously crafted to address the most common and critical needs of Laravel applications while maintaining a focus on code quality, security, and ease of use. This template is more than a starter kit—it’s an extensible platform designed to support your application from prototyping through to production deployment. With Premierstacks' Laravel Stack at its core, the template provides an architecture optimized for clean, maintainable, and scalable code, integrating seamlessly with Premierstacks' utilities for validation, authentication, and security.

One of the standout features of the Laravel App Template is its fully-integrated, production-ready authentication system. With comprehensive options for user registration, session management, password resets, and account verification, this template handles authentication needs with precision. API responses are pre-configured to return JSON format for streamlined integration with any frontend framework, and every endpoint supports multipart/form-data inputs, allowing rapid integration with mobile or web-based frontend clients. Error handling is uniform, covering validation and other exceptions with structured API responses, ensuring a consistent experience across the entire application.

This template also prioritizes security, offering middleware for throttling, request format validation, and content negotiation. With these security-focused layers in place, developers can ensure that applications built with the Laravel App Template are both resilient and performant, ready to handle production demands. Additionally, Premierstacks provides a robust routing and middleware configuration, enabling fine-grained control over session handling and request validation with minimal setup.

Customization is at the heart of this template. While it includes a powerful reference implementation, every component can be tailored or extended to meet specific project requirements. Premierstacks offers a flexible yet reliable configuration that allows developers to seamlessly integrate custom business logic, unique workflows, and any additional services required by the project. From authentication controllers and validation rules to route handling and middleware, every aspect of this template has been crafted for ease of modification and extension.

In summary, the Laravel App Template by Premierstacks is an unparalleled foundation for building robust Laravel applications. Whether you’re building a new project from scratch or looking to streamline an existing application, this template brings together best practices and advanced tooling in a comprehensive, ready-to-deploy package that simplifies development, ensures consistency, and maximizes scalability.

## Preconfigured Features

The Laravel App Template offers a robust set of pre-built features tailored for rapid, high-quality development. Here are the most notable components:

### Comprehensive API Endpoints

With a fully integrated API, this template provides a suite of ready-to-use endpoints for essential functionalities, including authentication, session management, and verification workflows. Each endpoint is configured for vnd.api+json responses, ensuring consistency across all interactions, including structured error handling.

```
# Returns an OpenAPI Swagger GUI for API exploration.
GET /api/swagger

# Retrieves the current authenticated user’s details.
POST /api/authenticatable/retrieve

# Sends a login verification request.
POST /api/authenticatable/login_verification

# Logs the user in with provided credentials.
POST /api/authenticatable/login

# Sends an email verification request for credential updates.
POST /api/authenticatable/email_verification

# Registers a new user.
POST /api/authenticatable/register

# Sends a verification request for account deletion.
POST /api/authenticatable/destroy_verification

# Deletes the authenticated user’s account.
POST /api/authenticatable/destroy

# Updates the authenticated user’s information.
POST /api/authenticatable/update

# Sends a verification for credentials update.
POST /api/authenticatable/update_credentials_verification

# Updates user credentials.
POST /api/authenticatable/update_credentials

# Shows details of the authenticated user.
GET /api/authenticatable/show

# Logs out the user from the current device.
POST /api/authenticatable/logout_current_device

# Logs out the user from other devices.
POST /api/authenticatable/logout_other_devices

# Logs out the user from all devices.
POST /api/authenticatable/logout_all_devices

# Sends a password reset verification request.
POST /api/authenticatable/reset_password_verification

# Resets the user’s password.
POST /api/authenticatable/reset_password

# Sends a verification request for password update.
POST /api/authenticatable/update_password_verification

# Updates the user’s password.
POST /api/authenticatable/update_password

# Invalidates the current session.
POST /api/sessions/invalidate

# Regenerates the session ID.
POST /api/sessions/regenerate

# Shows verification details.
GET /api/verifications/show

# Completes the verification process.
POST /api/verifications/complete
```

### JSON:API Response Format

All endpoints are configured to return responses in the vnd.api+json format, with uniform error handling across all request types, including validation and other exceptions. This setup provides frontend applications with structured, machine-readable responses, allowing for streamlined client-server communication.

### OpenAPI/Swagger Specification

An embedded Swagger interface is available, giving developers a comprehensive overview of all available API routes, request formats, and expected responses. This feature simplifies API exploration and integration by providing a user-friendly, interactive documentation tool.

### Multilingual Support

This template supports multiple languages for all user-facing content, including notifications, emails, validation messages, and error responses. Reference implementations for English (en), Slovak (sk), and Czech (cs) are included, making localization straightforward and ensuring accessibility across different languages.

### Full Premierstacks Ecosystem

Bundled with the Premierstacks ecosystem, the template includes the following tools and libraries for a complete development experience:

**[https://github.com/premierstacks/laravel-stack](https://github.com/premierstacks/laravel-stack)**

The Laravel Stack is a robust, pre-configured foundation for scalable Laravel applications, featuring essential tools for code quality, authentication, validation, and security. With modular configurations and helper utilities, it supports streamlined workflows, ideal for both rapid prototyping and production-ready deployments.

**[https://github.com/premierstacks/php-stack](https://github.com/premierstacks/php-stack)**

The PHP Stack is a versatile set of utility libraries and helper functions for PHP projects, designed to simplify common development tasks and provide robust support for building scalable and maintainable applications. It offers a cohesive set of tools that integrate seamlessly into any PHP project, helping developers work more efficiently.

**[https://github.com/premierstacks/php-cs-fixer-stack](https://github.com/premierstacks/php-cs-fixer-stack)**

The PHPCSFixer Stack is a pre-configured set of rules and templates specifically tailored for PHP projects. It streamlines the process of setting up PHP-CS-Fixer, making it easy to enforce consistent coding standards and best practices across your PHP codebase without the hassle of manual configuration.

**[https://github.com/premierstacks/phpstan-stack](https://github.com/premierstacks/phpstan-stack)**

The PHPStan Stack is a pre-configured collection of PHPStan setups designed to streamline static analysis for PHP projects. It provides ready-to-use configurations that enforce strict type safety and coding standards, allowing you to focus on building features instead of resolving analysis errors.

**[https://github.com/premierstacks/eslint-stack](https://github.com/premierstacks/eslint-stack)**

The ESLint Stack is a comprehensive set of pre-configured ESLint configurations for JavaScript, TypeScript, and React. It simplifies the process of integrating ESLint into projects, ensuring a consistent coding style and enforcing best practices across multiple environments—all with minimal setup effort.

**[https://github.com/premierstacks/prettier-stack](https://github.com/premierstacks/prettier-stack)**

The Prettier Stack is a fully-configured set of Prettier configurations that helps you maintain consistent code formatting across various JavaScript, TypeScript, and CSS projects. It’s designed to simplify the process of setting up and using Prettier, making it easy to integrate into any development workflow.

### Advanced Makefile CLI for Automation

The included Makefile streamlines all aspects of development and deployment, from code linting to running tests and managing migrations. Available commands cover:

**Setup and Provisioning:** `make local`, `make testing`, `make development`, `make staging`, `make production`<br />
**Testing and Linting:** `make check`, `make lint`, `make stan`, `make test`, `make audit`, `make coverage`<br />
**Code Formatting and Fixing:** `make commit`, `make fix`, `make compress`<br />
**Prototype:** `make start`<br />

## What is Tomchochola

[https://gitub.com/tomchochola](https://gitub.com/tomchochola)

This is my personal GitHub profile, where you’ll find public documentation and sample repositories for proprietary packages and templates from Premierstacks. These public repositories are designed to give you an overview of the best practices and high-quality code I follow in all my projects.

## What is Premierstacks

[https://gitub.com/premierstacks](https://gitub.com/premierstacks)

Premierstacks is a collection of exclusive, proprietary stacks and templates for PHP, JavaScript, TypeScript, React, and Laravel. It was created to address the common pain points developers face with many open-source projects—quality, consistency, and maintainability. With Premierstacks, you get high-quality tools built with strict attention to detail, designed to help you build and maintain better projects, faster.

## Why Premierstacks?

I created Premierstacks because I wasn’t satisfied with the quality of many open-source projects. Maintaining high-quality code and ensuring long-term reliability is challenging when you’re not earning from the product. When you pay for something, it means the creator truly cares about its success and is committed to delivering the best possible outcome.

Like Apple’s approach with their closed ecosystem, I believe that true excellence can only be achieved when every detail is under your control. That’s why Premierstacks is proprietary software—it's not just about providing solutions; it’s about ensuring those solutions meet the highest standards.

### Why You Should Choose Premierstacks

**🚀 Unmatched Quality**

Our solutions adhere to the highest standards, ensuring clean and maintainable code.

**⚙️ No Setup Hassles**

Pre-configured environments let you start coding immediately—no more complex setups.

**📦 Reuse Across Projects**

Each library and template is built to be reusable, reducing long-term maintenance.

**🔒 Exclusive Resources**

Premierstacks offers tools you won’t find in typical open-source collections.

**🛠️ Always Up-to-Date**

Receive continuous updates and new features, keeping your projects current.

**💪 Expert Creators**

Developed by experienced professionals dedicated to quality and excellence.

## License

**© 2024–Present Tomáš Chochola <chocholatom1997@gmail.com>. All rights reserved.**

This software is proprietary and licensed under specific terms set by its owner.<br />
Any form of access, use, or distribution requires a valid and active license.<br />
For full licensing terms, refer to the LICENSE.md file accompanying this software.<br />

**Purchase a license here: [Github Sponsors](https://github.com/sponsors/tomchochola)**

**See full terms here: [/LICENSE.md](/LICENSE.md)**

## Getting Started

**1. Review the documentation and license**

Ensure this package fits your needs and that you agree with the terms.

**2. Obtain a license**

**Purchase a license here: [Github Sponsors](https://github.com/sponsors/tomchochola)**

**3. Project Creation**

Use the `Use this template` button on the GitHub repository page to create a new repository from this template.

Or clone the repository using the following command:

```bash
git clone https://github.com/premierstacks/laravel-app-template.git
```

**4. Customize Your Project**

Explore the generated repository, remove unnecessary components and adjust it to fit your project's needs.

**5. CLI**

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

# run before every commit
make commit

# images/assets compression
make compress
```

## About the Creator

I'm Tomáš Chochola, a software developer dedicated to creating exclusive, enterprise-grade software solutions. I specialize in building packages and templates for PHP, JavaScript, and TypeScript, tailored to streamline development workflows, enforce best practices, and save you time.

My mission is to develop reusable solutions that enhance code quality, boost productivity, and ensure that projects remain maintainable and scalable over the long term.

### Specializations

**Backend Development:** Expert in PHP and Laravel<br />
**Frontend Development:** Mastery in TypeScript, React, and JavaScript<br />
**DevOps:** Proficient in managing Ubuntu and AWS environments<br />
**Security:** Focused on implementing best practices and enforcing code standards<br />
**Tooling:** Extensive experience with ESLint, Prettier, PHP CS Fixer, Stylelint, and PHPStan<br />
**Reusable Solutions:** Creating templates and configuration stacks for optimized development<br />
**Development Environments:** Fluent in Windows 11 and Ubuntu (WSL2)<br />

## Contact

**📧 Email: <chocholatom1997@gmail.com>**<br />
**💻 Website: [https://premierstacks.com](https://premierstacks.com)**<br />
**👨 GitHub Personal: [https://github.com/tomchochola](https://github.com/tomchochola)**<br />
**🏢 GitHub Organization: [https://github.com/premierstacks](https://github.com/premierstacks)**<br />
**💰 GitHub Sponsors: [https://github.com/sponsors/tomchochola](https://github.com/sponsors/tomchochola)**<br />

## Tree

The following is a breakdown of the folder and file structure within this repository. It provides an overview of how the code is organized and where to find key components.

```bash
.
├── .editorconfig
├── .env.development.example
├── .env.local.example
├── .env.production.example
├── .env.staging.example
├── .env.testing.example
├── .gitattributes
├── .gitignore
├── .php-cs-fixer.php
├── .prettierignore
├── AUTHORS.md
├── LICENSE.md
├── Makefile
├── README.md
├── app
│   ├── Models
│   │   └── User.php
│   └── Providers
│       └── AppServiceProvider.php
├── artisan
├── bootstrap
│   ├── app.php
│   ├── cache
│   └── providers.php
├── composer.json
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database
│   ├── factories
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 0001_01_01_000000_create_framework_tables.php
│   │   └── 0001_01_01_000001_create_auth_tables.php
│   └── seeders
│       └── DatabaseSeeder.php
├── eslint.config.js
├── lang
│   ├── cs
│   │   ├── actions.php
│   │   ├── auth.php
│   │   ├── notifications.php
│   │   ├── pagination.php
│   │   ├── passwords.php
│   │   ├── statuses.php
│   │   └── validation.php
│   ├── cs.json
│   ├── en
│   │   ├── actions.php
│   │   ├── auth.php
│   │   ├── notifications.php
│   │   ├── pagination.php
│   │   ├── passwords.php
│   │   ├── statuses.php
│   │   └── validation.php
│   ├── en.json
│   ├── sk
│   │   ├── actions.php
│   │   ├── auth.php
│   │   ├── notifications.php
│   │   ├── pagination.php
│   │   ├── passwords.php
│   │   ├── statuses.php
│   │   └── validation.php
│   └── sk.json
├── package.json
├── phpstan.neon
├── phpunit.xml
├── prettier.config.js
├── public
│   ├── docs
│   │   ├── httpie.sh
│   │   └── openapi.json
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources
│   └── views
│       └── errors
│           ├── 1xx.blade.php
│           ├── 2xx.blade.php
│           ├── 3xx.blade.php
│           ├── 401.blade.php
│           ├── 402.blade.php
│           ├── 403.blade.php
│           ├── 404.blade.php
│           ├── 419.blade.php
│           ├── 429.blade.php
│           ├── 4xx.blade.php
│           ├── 500.blade.php
│           ├── 503.blade.php
│           └── 5xx.blade.php
├── routes
│   ├── console.php
│   └── http.php
├── storage
│   ├── app
│   │   ├── private
│   │   └── public
│   ├── framework
│   │   ├── cache
│   │   │   └── data
│   │   ├── sessions
│   │   ├── testing
│   │   └── views
│   └── logs
└── tests
    ├── Feature
    │   └── NotFoundControllerTest.php
    ├── TestCase.php
    └── Unit
        └── ExampleTest.php

34 directories, 89 files
```
