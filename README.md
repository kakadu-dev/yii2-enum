# yii2-enum
Extension provide very simply use enum for models (and others) in yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist matthew-p/yii2-services "*"
```

or add

```
"kakadu-dev/yii2-enum": "@dev"
```

to the require section of your `composer.json` file.

Usage
-----

Once the extension is installed, simply use it in your code by:

Create directory structure for model "User" (only example, not required):

```
common/  
    models/    
        Users/  
            Enums/
                UserStatus.php
            User.php
            UserQuery.php
```

UserStatus class example:
```php
<?php

namespace common\models\Users\Enums;

use Yii;
use Kakadu\Yii2Enum\Enum;

class UserStatus extends Enum
{
    const DELETED = 0;
    const ACTIVE  = 1;

    protected static $attribute = 'status';

    public static function all(): array
    {
        return [
            self::DELETED => Yii::t('app', 'Deleted'),
            self::ACTIVE  => Yii::t('app', 'Active'),
        ];
    }
}
```

And use:

```php
namespace common\models\Users;

use common\models\Users\Enums\UserStatus;

class User extends ActiveRecord
{
    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => UserStatus::ACTIVE],
            ['status', 'in', 'range' => UserStatus::keys()],
        ];
    }
    ...
}
```

More examples:
```php
$model = new User(['status' => UserStatus::ACTIVE]);

if (UserStatus::has($model, UserStatus::ACTIVE)) {
    // do something
}

// DetailView widget (or GridView)
DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        'name',
        [
            'attribute' => 'status',
            'filter'    => UserStatus::all(),
            'value'     => UserStatus::get($model->status),
        ],
        ...
    ],
])

// In form
$form->field($model, 'status')->dropDownList(UserStatus::all())
```

That's all. Check it.