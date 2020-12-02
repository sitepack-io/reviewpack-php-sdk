
# ReviewPack PHP SDK library

_Note: this SDK is still is testing phase._

## Examples

#### List companies

```php
$companyEndpoint = new \ReviewPack\Endpoint\CompanyEndpoint();
$collection = $companyEndpoint->getCompanies(
    'secret',
    'token',
);
var_dump($collection);
```

#### Get company review scores (total, average)

```php
$reviewEndpoint = new \ReviewPack\Endpoint\ReviewEndpoint();
$scores = $reviewEndpoint->getCompanyReviewScores(
    'secret',
    'token',
    'company_uuid'
);
var_dump($scores);
```

#### Get the newest reviews of a company

```php
$reviewEndpoint = new \ReviewPack\Endpoint\ReviewEndpoint();
$recentReviews = $reviewEndpoint->getNewestReviews(
    'secret',
    'token',
    'company_uuid'
);
var_dump($recentReviews);
```

_Copyright SitePack B.V._