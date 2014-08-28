# TODO V3

## Ports and Adapters approach
- Cleaner code
- Value objects to validate fields that behave like ENUMs.
- Create entities that use XMLWriter (eg: http://es1.php.net/manual/es/function.xmlwriter-write-cdata.php)

## Recycling items and avoid creating new instances
- Each item created should be converted to string just created.
- Same Item entity shall be reused instead of creating many.

## file_put_contents in APPEND MODE
- Write the file little by little instead of having an in-memory variable holding all data
- This will stop reaching php's memory limit.
