# DynoTables

DynoTables is a dynamic, server-side PHP solution for generating paginated HTML tables. It allows you to easily display large datasets in a paginated format with independent pagination controls for multiple tables on the same page.

## Features

- **Dynamic Table Generation**: Automatically generate tables from PHP arrays.
- **Independent Pagination**: Each table has its own set of pagination controls.
- **Bootstrap Integration**: Styled using Bootstrap for a clean, responsive look.
- **No Conflicts Between Tables**: Each table's pagination is handled independently.

## Prerequisites

- PHP 7.x or higher
- A web server (like Apache or Nginx) to run the PHP code
- Internet connection to load external libraries (Bootstrap and jQuery)

## Installation

1. Clone the repository or download the source code

2. Ensure your server is configured to serve PHP files.

3. Place the files in a directory accessible by your web server.

## Usage

1. Open `index.php` in a web browser. This file demonstrates the usage of the `build_dynotable` function to generate two separate tables with independent pagination controls.

2. Modify the data arrays (`$records` and `$otherRecords` in `index.php`) to display your own data.

3. Customize the table styles or pagination settings by editing the `build_dynotable` function in `dynoTables.php`.

## Example

Here is an example of how to use the `build_dynotable` function:

```php
<?php 
require_once './dynoTables.php';
$records = [
    ['id' => 1, 'name' => 'Item 1', 'date' => '2024-09-01'],
    ['id' => 2, 'name' => 'Item 2', 'date' => '2024-09-02'],
    // Add more records as needed...
];

echo build_dynotable($records);
?>
