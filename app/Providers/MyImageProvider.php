<?php
 
use Swis\Filament\Backgrounds\Contracts\ProvidesImages;
use Swis\Filament\Backgrounds\Image;
 
class MyImageProvider implements ProvidesImages
{
    public static function make(): static
    {
        return app(static::class);
    }
 
    public function getImage(): Image
    {
        return new Image(
            'url("[link to photo]")',
            'Photo by ...'
        );
    }
}