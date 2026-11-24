<?php

declare(strict_types=1);

namespace App\Service;

final class LegacyBoxOfficeService
{
    public function formatBadge(array $entry): string
    {
        $tag = $entry['tag'] ?? null;
        $title = (string) ($entry['title'] ?? '');

        // Cahier des charges : sans tag renseigné, le film porte le badge [STANDARD]
        if ($tag === null || trim((string) $tag) === '') {
            $tag = 'standard';
        }

        return '[' . strtoupper((string) $tag) . '] ' . $title;
    }

    /**
     * @param array<int, int|float|null> $ratings
     */
    public function calculateAverageRating(array $ratings): float
    {
        // On ignore les notes absentes (null) pour ne pas fausser la moyenne
        $validRatings = array_filter($ratings, static fn ($rating): bool => $rating !== null);

        if (count($validRatings) === 0) {
            return 0.0;
        }

        $average = array_sum($validRatings) / count($validRatings);

        return round($average, 1);
    }

    public function calculateTicketPrice(float $basePrice, int $age, bool $isMember): float
    {
        $price = $basePrice;

        // -25 % pour les moins de 18 ans et dès 65 ans inclus
        if ($age < 18 || $age >= 65) {
            $price *= 0.75;
        }

        // -20 % pour les abonnés, cumulable avec la remise d'âge
        if ($isMember) {
            $price *= 0.80;
        }

        return round($price, 2);
    }
}
