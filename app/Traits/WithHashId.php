<?php

    namespace App\Traits;

    use Bvtterfly\LaravelHashids\HasHashId;
    use Bvtterfly\LaravelHashids\HashIdOptions;
    use Illuminate\Contracts\Database\Query\Builder;

    trait WithHashId
    {
        use HasHashId;

        public function getHashIdOptions(): HashIdOptions
        {
            return HashIdOptions::create()
                ->saveHashIdTo('hashid')
                ->setMinimumHashLength(50)
                ->setAlphabet('abcdefghijklmnopqrstuvwxyz1234567890');
        }

        public function scopeHashid(Builder $builder, string $hashid)
        {
            return $builder->where('hashid', $hashid);
        }

        public static function getId(string $hashid)
        {
            return static::hashid($hashid)->first()?->id;
        }

        public function getRouteKeyName()
        {
            return 'hashid';
        }

    }
