# Angle Mexico CURP
PHP utility to handle Mexico's RENAPO (Registro Nacional de Población) CURP (Clave Única de Registro de Población)


## CURP
What is CURP? 
_Clave Única de Registro de Población_ for the Mexican Population Registry: RENAPO _Registro Nacional de Población_.

## How to Use
#### Validate CURP strings
The utility can be used to validate a CURP string.

```php
echo (CURP::isValid('BAD-CURP-STRING') ? 'Yes' : 'No'); // No
```

## Tests

```bash
php vendor/bin/phpunit tests/CurpTest.php
```

## TO-DO
- Finish writing up this README
- Extract data from the CURP (Date of Birth, Gender, State of Birth)
