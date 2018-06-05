# yii2-enum
Extension provide very simply use enum for models (and others) in yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kakadu-dev/yii2-enum "@dev"
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
            Enum/
                UserStatus.php
            User.php
            UserQuery.php
```

UserStatus class example:
```php
<?php

namespace common\models\Users\Enum;

use Yii;
use Kakadu\Yii2Enum\Enum;

/**
 * Class    UserStatus
 * @package common\models\Users\Enum
 * @author  
 * @version 1.0
 */
class UserStatus extends Enum
{
    const DELETED = 0;
    const ACTIVE  = 1;

    /**
     * @inheritdoc
     */
    protected static $attribute = 'status';

    /**
     * @inheritdoc
     */
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
...

use common\models\Users\Enum\UserStatus;
...

class User extends ActiveRecord implements IdentityInterface
{
    ...
    
    /**
     * {@inheritdoc}
     */
    public function rules()
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
    //
}

// DetailView widget (or GridView)
DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        'name',
        [
            'attribute' => 'status',
            'format'    => 'raw',
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
