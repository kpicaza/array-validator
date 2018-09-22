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
    'name' => 'minLength:2'
];
```

* **maxLength**: Assert that string is smaller than a given number.

```php
<?php

$rules = [
    'name' => 'maxLength:70'
];
```

* **betweenLength**: Assert that string is between of given numbers.

```php
<?php

$rules = [
    'name' => 'betweenLength:10,70'
];
```

* **date**: Assert that data string has a given format(see [php date formats](http://php.net/manual/es/function.date.php)).

```php
<?php

$rules = [
    'event_date' => 'date:Y-m-d'
];
```

* **email**: Assert that string has valid email format.

```php
<?php

$rules = [
    'email_address' => 'email'
];
```

* **choice**: Assert that given data is one of given choices

```php
<?php

$rules = [
    'survey_1' => 'choice:(yes,no)'
];
```

* **inArray**: Assert that given value is in in given array

```php
<?php

$rules = [
    'booking_date' => 'inArray:(2018-09-23,2018-09-24,2018-09-25)'
];
```

* **noInArray**: Assert that given value is in not in given array

```php
<?php

$rules = [
    'booking_date' => 'inArray:(2018-09-23,2018-09-24,2018-09-25)'
];
```
