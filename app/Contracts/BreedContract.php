<?php

namespace App\Contracts;

use App\Breed;

/**
 * Interface BreedContract
 *
 * @package App\Contracts
 */
interface BreedContract
{

    /**
     * @param string $breedId
     *
     * @return Breed
     */
    public function getByName(string $breedId) : Breed;

    /**
     * @param string $id
     * @param string $name
     * @param string $temperament
     * @param string $lifeSpan
     * @param string $altNames
     * @param string $wikipediaUrl
     * @param string $origin
     * @param string $weightImperial
     * @param bool   $experimental
     * @param bool   $hairless
     * @param bool   $natural
     * @param bool   $rex
     * @param bool   $suppressTail
     * @param bool   $shortLegs
     * @param bool   $hypoallergenic
     * @param int    $adaptability
     * @param int    $affectionLevel
     * @param string $countryCode
     * @param int    $childFriendly
     * @param int    $dogFriendly
     * @param int    $energyLevel
     * @param int    $grooming
     * @param int    $healthIssues
     * @param int    $intelligence
     * @param int    $sheddingLevel
     * @param int    $socialNeeds
     * @param int    $strangerFriendly
     * @param int    $vocalisation
     *
     * @return Breed
     */
    public function create(
        string $id,
        string $name,
        string $temperament,
        string $lifeSpan,
        string $altNames,
        string $wikipediaUrl,
        string $origin,
        string $weightImperial,
        bool $experimental,
        bool $hairless,
        bool $natural,
        bool $rex,
        bool $suppressTail,
        bool $shortLegs,
        bool $hypoallergenic,
        int $adaptability,
        int $affectionLevel,
        string $countryCode,
        int $childFriendly,
        int $dogFriendly,
        int $energyLevel,
        int $grooming,
        int $healthIssues,
        int $intelligence,
        int $sheddingLevel,
        int $socialNeeds,
        int $strangerFriendly,
        int $vocalisation
    ) : Breed;
}
