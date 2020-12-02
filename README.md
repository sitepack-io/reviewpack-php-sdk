
# ReviewPack PHP SDK library

_Note: this SDK is still is testing phase._

This library is very helpful when you want to implement the ReviewPack API in a project. It has all API calls implemented, so you can call them easily from your application.

## Examples

#### List companies

See also our [official documentation](https://reviewpack.nl/developers-api#list-companies) for the list companies endpoint.

```php
$companyEndpoint = new \ReviewPack\Endpoint\CompanyEndpoint();
$collection = $companyEndpoint->getCompanies(
    'token',
    'secret',
);
var_dump($collection);
```

#### Invite a customer for a review

See also our [official documentation](https://reviewpack.nl/developers-api#plan-invite) to plan a customer invite for a review.

```php
$inviteEndpoint = new \ReviewPack\Endpoint\InviteEndpoint();

$result = $inviteEndpoint->createInvite(
    'token',
    'secret',
    'company',
    'email',
    'first_name'
);
var_dump($result);
```

#### Get company review scores (total, average)

See also our [official documentation](https://reviewpack.nl/developers-api#review-scores) for the average scoring endpoint.

```php
$reviewEndpoint = new \ReviewPack\Endpoint\ReviewEndpoint();
$scores = $reviewEndpoint->getCompanyReviewScores(
    'token',
    'secret',
    'company_uuid'
);
var_dump($scores);
```

#### Get the newest reviews of a company

See also our [official documentation](https://reviewpack.nl/developers-api#newest-reviews) for the newest reviews of a specific company.

```php
$reviewEndpoint = new \ReviewPack\Endpoint\ReviewEndpoint();
$recentReviews = $reviewEndpoint->getNewestReviews(
    'token',
    'secret',
    'company_uuid'
);
var_dump($recentReviews);
```

_Copyright SitePack B.V._