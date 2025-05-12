# Sistem Informasi Manajemen Pemantauan Proyek PT. Pilar Presisi

## Description

Sebuah aplikasi web berbasis Laravel yang digunakan untuk menunjang pemantauan proyek di perusahaan PT. Pilar Presisi.

## Features

- Coming Soon!

## Requirements

- PHP >= 8.0
- Laravel >= 12
- Composer
- MySQL or SQLite

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/your-repo-name.git
    cd your-repo-name
    ```

2. **Install dependencies**:
    ```bash
    composer install
    ```

3. **Set up the environment file**:
    - Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```

    - Update the `.env` file with your database credentials and other environment variables.

4. **Generate the application key**:
    ```bash
    php artisan key:generate
    ```

5. **Run migrations**:
    ```bash
    php artisan migrate
    ```

6. **Run the application**:
    ```bash
    php artisan serve
    ```

The application should now be running on `http://localhost:8000`.


## Running Tests

To run the unit tests for the application, use the following command:

```bash
php artisan test

### Commit Messages

Format Commit: `<type>: <subject>`

### Example Commit

```bash
feat: add hat wobble
^--^  ^------------^
|     |
|     +-> Summary in present tense.
|
+-------> Type: chore, docs, feat, fix, refactor, style, or test.
```

More Examples:

- `feat`: (new feature for the user, not a new feature for build script)
- `fix`: (bug fix for the user, not a fix to a build script)
- `docs`: (changes to the documentation)
- `style`: (formatting, missing semi colons, etc; no production code change)
- `refactor`: (refactoring production code, eg. renaming a variable)
- `test`: (adding missing tests, refactoring tests; no production code change)
- `chore`: (updating grunt tasks etc; no production code change)