<?php

namespace Tulo\V1\Hydrator\Strategy;

use Doctrine\Common\Collections\Collection;
use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;
use Innovation\Entity\InnovationIndicatorAttachments;
use Tulo\Entity\CardAttachment as CardAttachmentEntity;

class InnovationIndicatorAttachmentsStrategy extends AbstractCollectionStrategy
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @param  string  $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl . '/photo/innovation/indicator/attachments';
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param  mixed $values The original value.
     * @param  object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     * @throws \RuntimeException If object os not a User
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function extract($values, $object = null)
    {
        $results = [];
        if ($values instanceof Collection) {
            foreach ($values as $value) {
                if ($value instanceof InnovationIndicatorAttachments)
                    $results[] = [
                        'uuid'      => $value->getUuid(),
                        'filename'  => $value->getAttachmentUploadedFilename(),
                        'name'  => $value->getName(),
                        'numberOfLetter'  => $value->getNumberOfLetter(),
                        'dateOfLetter'  => $value->getDateOfLetter()->format('c'),
                        'youtubeUrl'  => $value->getYoutubeUrl(),
                        'url'       => $this->baseUrl . '/' . $value->getAttachmentSavedFilename(),
                    ];
            }
        }

        return $results;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     * @throws \InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function hydrate($value, array $data = null)
    {
        return $value;
    }

    /**
     * @param  \DateTime|null  $date
     * @param  string  $format
     * @return string|null
     */
    protected function formatDateTimeMaybeNull($date, $format)
    {
        if ($date instanceof \DateTime)
            return $date->format($format);
        return null;
    }
}
