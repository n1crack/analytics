## Analytics Package

Analytics Package for Google Analytics Data API V4


### Installation
Run
```bash
$ composer require ozdemir/analytics
```

### Usage
```php
# Main Library
use Ozdemir\Analytics\Analytics;
use Ozdemir\Analytics\Period;

# Reports  
use Ozdemir\Analytics\Requests\PageViewsByCountry;
use Ozdemir\Analytics\Requests\PageViewsByReferer;

# Optional, if you need more reports, you can use these or create your own custom.
use Ozdemir\Analytics\Requests\PageViews;
use Ozdemir\Analytics\Requests\PageViewsAndUsers;
use Ozdemir\Analytics\Requests\TopBrowsers;
use Ozdemir\Analytics\Requests\TotalUsersByChannels;
use Ozdemir\Analytics\Requests\MostVisitedPages;


$config = [
    'property' => '11111111', // Google Analytics Property ID
    'credentials' => __DIR__ . '/credentials.json'  // credentials.json file path or config array
];

# we load the library
$analytics = new Analytics($config);

# Requests are defined in an array
# Up to 5 requests can be executed in one batch request.
# It is set by Google, so we can't increase this at the moment.
$response = $analytics->fetch([
    new PageViewsAndUsers(
        Period::days(7)
    ),

    new PageViewsByReferer(
        Period::days(7),
        5   # row limit, only returns 5 rows
    ),
]);

# We can use the response value as we want.this is quite configurable.
# get($index): index number is the same order of the defined requests above.
# we can also cache the output as we want. It is very easy with the laravel.
return [
    'pageViews' => $response->get(0)->toChartJs(),  // ->toJson() is also available.
    'pageViewsByCountry' => $response->get(1)->toChartJs(),
];

```


#### todo:

  - make a better readme / tutorial
  - add unit tests
