# CRUD_SKELETON_LARAVEL_5.2

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

# How to run skeleton?

- clone this source code, in ```.env``` file update your database info.For example
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=CRUD_example
DB_USERNAME=root
DB_PASSWORD=
```
- open terminal and migrate database 
```php artisan migrate```
- open browser and past this link 
```http://localhost/YOUR__SERVER_FOLDER/public/admin/category```

your browser should display like this 

![untitled](https://cloud.githubusercontent.com/assets/26756140/24553748/6f1e3da4-1655-11e7-9ee4-a99e1e465dea.png)

# How does it work?

- To create CRUD table 

1.you need provide some info : Get and Post router, uniqueField in your table, private key of your table,validate form when create new data and validate form when update data
For Example : 

```php
    private $mRouter = ['GET' => 'get_category', 'POST' => 'post_category'];
    private $uniqueFields = array('name');
    private $privateKey = 'id';
    private $validateForm = ['name'=>'required|max:255'];
    private $validateFormUpdate = ['name'=>'required|max:255'];
```
if you have file fiel you need provide file field and file path in your table 
For example : 
```php
private $fieldFile = array('image');
private $fieldPath = array('image_path');
```
*note : you must use _path prefix in your field path

if you have foreign key in your table you must provide foreignData array follow format and return it value to view use ```foreignData``` key
Please open NewPostController to get example
```php
$category = ['fr_id' =>'category_id',
            'fr_data'=>$this->getDataByModel(new Category()),
            'fr_private_id' =>'id',
            'fr_select_field' => 'name',
            'label' => 'Category'
        ];
$this->foreignData = [$category];
```
2. Progress POST (CREATE and UPDATE data) :
  - progress all data you need create from your form 
  ```php
  $active = !empty($request->get('active')) ? 1 : 0 ;
  $progressData = ['active' => $active,'name' => $request->get('name')];
  ```
  if you have file field in table you need progreesFileData
  ```php 
  $progressData =  $this->progressFileData($request,$this->fieldFile,$progressData);
  ```          
  - progress Post data and get validate return to display at view
  
  ```php
  $this->validateMaker = $this->progressPost($request,$progressData)->parseMessageToValidateMaker();
  ```
3. Progress Get (READ and DELETE data)
 - Just provide request data to progressGet function and get return validate info 
```php 
$this->validateMaker = $this->progressGet($request)->parseMessageToValidateMaker();
```

# CRUD_SKELETON_LARAVEL_5.2
# CRUD_SKELETON_LARAVEL_5.2
