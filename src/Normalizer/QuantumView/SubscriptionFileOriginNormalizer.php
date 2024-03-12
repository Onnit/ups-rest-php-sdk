<?php

namespace ShipStream\Ups\Normalizer\QuantumView;

use ShipStream\Ups\Api\Normalizer\SubscriptionFileOriginNormalizer as BaseNormalizer;
use function array_is_list;
use function is_array;

class SubscriptionFileOriginNormalizer extends BaseNormalizer
{
    /**
     * @inheritDoc
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if ($data === null || is_array($data) === false) {
            return parent::denormalize($data, $type, $format, $context);
        }

        // Force fields to always be an array even when the API returns a single value
        if (isset($data['PackageReferenceNumber']) && ! array_is_list($data['PackageReferenceNumber'])) {
            $data['PackageReferenceNumber'] = [$data['PackageReferenceNumber']];
        }
        if (isset($data['ShipmentReferenceNumber']) && ! array_is_list($data['ShipmentReferenceNumber'])) {
            $data['ShipmentReferenceNumber'] = [$data['ShipmentReferenceNumber']];
        }
        return parent::denormalize($data, $type, $format, $context);
    }
}
