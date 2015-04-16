# wp-acf-devtool
php api wrapper for wordperss ACF plugin

Пример использования:
```php
  // Создание новой группы полей
  $acf = new ACFGroup('links', 'Дополнительные поля');
  $acf
      ->forPostType('links') // Тип поста
      ->addTextField('link','Ссылка')
      ->addTextField('linkDemo','Ссылка на Demo')
      ->addImgField('img','Фото')
      ->register();
```
