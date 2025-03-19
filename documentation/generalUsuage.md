## Displaying View Files

Use the `view()` method to display a PHP file inside the `resources/views/` folder.
`$data` (Optional) An associative array of data that will be passed to the view.

### Example:
```php
public function index()
{
    return view("auth/register");
    return view("auth/register", $data);
}

```
## Importing Files from the Component Folder

To import a file from the `components` folder, use the `component()` method.

### Example:
```php
<div>
    <?php component("authheader") ?>
    <?php component("authheader", $data) ?>
</div>
```
