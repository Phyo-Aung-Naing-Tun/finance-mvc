
# 🛠️ Create Migration File

This guide explains how to create a migration file using the PHP Lite CLI command and how the migration system works.

---
## ⚙️ Command

To migrate migration files, use the following CLI command:

```bash
php lite migrate 
```
## 🎯 Run a Specific Migration

### Run Single Migration File

## ⚙️ Command

```bash
php lite migrate 2025_04_30_151346_create_wallet_table
```

This command will only run the specified migration file. The filename must match exactly (without the `.php` extension).

---

## ⚙️ Command

To generate a new migration file, use the following CLI command:

```bash
php lite make:migration name=your_migration_name table=YourTableName
```

- `name` — The name of the migration.
- `table` — The name of the table you want to create.

A new migration file will be created in the `migration/` directory with the boilerplate structure.

---

## 📁 Sample Migration File

Here’s what a generated migration file looks like:

```php
<?php

use Root\App\Services\Migration\Blueprint;
use Root\App\Services\Migration\Schema;
use Root\App\Services\Migration\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('users', function (Blueprint $table) {
             $table->id();
             $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('users');
    }
};
```

---

## 🧱 `Blueprint` Class API

The `Blueprint` class defines the columns and structure for a table.

### Available Methods

| Method | Description |
|--------|-------------|
| `id($name = "id")` | Adds an `INT` primary key with auto-increment. |
| `string($name, $length = 225)` | Adds a `VARCHAR(length)` column. |
| `int($name)` | Adds an `INT` column. |
| `text($name)` | Adds a `TEXT` column. |
| `bool($name)` | Adds a `BOOLEAN` column. |
| `timestamps()` | Adds `created_at` and `updated_at` columns. |
| `timestamps($name)` | Adds a custom timestamp column. |
| `nullable()` | Makes the last defined column nullable. |
| `default($value)` | Sets a default value for the last defined column. |

---

## 🛠 Example Usage

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title', 150)->nullable();
    $table->text('body');
    $table->bool('is_published')->default(false);
    $table->timestamps();
});
```

This will generate a SQL query like:

```sql
CREATE TABLE `posts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY UNIQUE NOT NULL,
    `title` VARCHAR(150) NULL,
    `body` TEXT NOT NULL,
    `is_published` BOOLEAN NOT NULL DEFAULT false,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
);
```

---

## 🧹 Rollback Migration

To reverse a migration, define the `down()` method using:

```php
Schema::dropIfExists('posts');
```

This will generate:

```sql
DROP TABLE IF EXISTS `posts`;
```

---

## ✅ Summary

With this system, you can easily:

- Generate migration files using CLI.
- Define database schemas in PHP using a fluent interface.
- Run and rollback migrations efficiently.

---

Happy coding! ✨
