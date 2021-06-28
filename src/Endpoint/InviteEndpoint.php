<?php

namespace ReviewPack\Endpoint;

use ReviewPack\Resources\Company;
use ReviewPack\Resources\Invite;
use ReviewPack\ValueObjects\ReferenceCollection;

/**
 * Class InviteEndpoint
 * @package ReviewPack\Endpoint
 */
class InviteEndpoint extends AbstractEndpoint
{

    /**
     * Create and plan an invite for a customer review.
     *
     * @param string $token
     * @param string $secret
     * @param string $companyUuid
     * @param string $email
     * @param string $firstName
     * @param string|null $lastName
     * @param \DateTimeImmutable|null $plannedDate
     * @param int|null $totalOrderAmountCents
     * @param string|null $mailGreeting
     * @param ReferenceCollection|null $referenceCollection
     * @return mixed
     * @throws \ReviewPack\Exception\ApiAuthorizationError
     * @throws \ReviewPack\Exception\ApiResponseError
     */
    public function createInvite(
        string $token,
        string $secret,
        string $companyUuid,
        string $email,
        string $firstName,
        ?string $lastName = null,
        ?\DateTimeImmutable $plannedDate = null,
        ?int $totalOrderAmountCents = null,
        ?string $mailGreeting = null,
        ?ReferenceCollection $referenceCollection = null
    )
    {
        $postData = [
            'company' => $companyUuid,
            'email' => $email,
            'first_name' => $firstName
        ];

        if (!\is_null($lastName)) {
            $postData['last_name'] = $lastName;
        }
        if (!\is_null($mailGreeting)) {
            $postData['mail_greeting'] = $mailGreeting;
        }
        if (!\is_null($plannedDate)) {
            $postData['date'] = $plannedDate->format('Y-m-d H:i:s');
        }
        if (!\is_null($totalOrderAmountCents)) {
            $postData['total_order_cents'] = $totalOrderAmountCents;
        }

        if ($referenceCollection instanceof ReferenceCollection) {
            $postData = $this->mapReferenceCollectionToData($postData, $referenceCollection);
        }

        $data = $this->executeApiCall(
            AbstractEndpoint::METHOD_POST,
            '/api/invites/add',
            true,
            $token,
            $secret,
            $postData
        );

        return $this->mapDataToObject($data, Invite::class);
    }

    /**
     * @param array $postData
     * @param ReferenceCollection $referenceCollection
     * @return array
     */
    private function mapReferenceCollectionToData(array $postData, ReferenceCollection $referenceCollection): array
    {
        if (!empty($referenceCollection->getFirstReference())) {
            $postData['reference_one'] = \trim($referenceCollection->getFirstReference());
        }
        if (!empty($referenceCollection->getSecondReference())) {
            $postData['reference_two'] = \trim($referenceCollection->getSecondReference());
        }
        if (!empty($referenceCollection->getThirdReference())) {
            $postData['reference_three'] = \trim($referenceCollection->getThirdReference());
        }
        if (!empty($referenceCollection->getFourthReference())) {
            $postData['reference_four'] = \trim($referenceCollection->getFourthReference());
        }
        if (!empty($referenceCollection->getFifthReference())) {
            $postData['reference_five'] = \trim($referenceCollection->getFifthReference());
        }

        return $postData;
    }

}