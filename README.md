# phpunit-slot
A feature that allows you to capture method parameters as you would do with Mockk capture() - https://mockk.io/#capturing

Well, I just created this package to make parameter assertions more readable (my personal thought).

Of course you can say doing the way below already work, but I dunno when there's a need to add a callback for each parameter it didn't look well to me.

That's why I decided to create this package and make this more the way I was used to in Kotlin (with the [mockk](https://mockk.io/#capturing) library =)

```php
->with(self::callback(function ($object): bool {
    self::assertInstanceOf(MyObject::class, $object);
    self::assertEquals('value', $object->getValue());
    return true;
}))
```

Instead of that I am doing something like this

```php
->with($slot->capture())

//other mock declarations

//then
self::assertInstanceOf(MyObject::class, $slot->captured);
self::assertEquals('value', $slot->captured->getValue());
```