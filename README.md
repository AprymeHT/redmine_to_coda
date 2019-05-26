# Service for sync data between Coda & Redmine



Подключение пакетов с помощью Composer
-
Установите [Composer](https://getcomposer.org/). Отредактируйте *composer.json* 
```javascript
{
    "name": "yourproject/yourproject",
    "type": "project",
    "require": {
            "aprymeht/redmine_to_coda"
        }
}
```
Запустите `composer update`

 
Настройка
-
- Необходимо создать yaml файл со следующими настройками:

```
redmineSettings:
  url: (Redmine URL)
  key: (Access key)

codaSettings:
  tokenCoda: (Token)
  docId: (Document ID)
  table: (Table namme)
```  

- Далее объявить в коде:
```php
$var = new Sync(path_to_yaml);

$var->sync();
```
