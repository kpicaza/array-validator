# Predefined Rule set

* **notEmpty**: Assert that variable has any value.
```php
<?php

$rules = [
    'name' => 'notEmpty'
];
```

* **minLength**: Assert that string is greater than a given number.
```php
<?php

$rules = [
    'name' => 'notEmpty|minLength:2'
];
```

* **maxLength**: Assert that string is smaller than a given number.
```php
<?php

$rules = [
    'name' => 'notEmpty|maxLength:70'
];
```
