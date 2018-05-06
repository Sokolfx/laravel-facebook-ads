<?php

namespace Edbizarro\LaravelFacebookAds\Entities;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Arrayable;
use Edbizarro\LaravelFacebookAds\Traits\AdFormatter;
use FacebookAds\Object\AdAccount as FbAdAccount;

/**
 * Class AdAccount.
 */
class AdAccount extends Entity implements Arrayable
{
    use AdFormatter;

    /**
     * @var FbAdAccount
     */
    protected $fbAdAccount = [];

    /**
     * AdAccount constructor.
     *
     * @param FbAdAccount $facebookAdAccount
     */
    public function __construct(FbAdAccount $facebookAdAccount)
    {
        $this->fbAdAccount = $facebookAdAccount;
    }

    /**
     * Get the account ads.
     *
     * @param array $fields
     *
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/adgroup#Reading
     * @throws \Edbizarro\LaravelFacebookAds\Exceptions\MissingEntityFormatter
     */
    public function ads(array $fields = []): Collection
    {
        $ads = $this->fbAdAccount->getAds($fields);

        return $this->format($ads);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->fbAdAccount->getData())) {
            return $this->fbAdAccount->getData()[$name];
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->FbAdAccount->getData();
    }
}
