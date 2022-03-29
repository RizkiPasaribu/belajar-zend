<?php

namespace Innovation\V1\Hydrator\Strategy;

use Doctrine\Common\Collections\Collection;
use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;
use Innovation\Entity\InnovationIndicatorAttachments;
use Innovation\Entity\InnovationIndicators;

class InnovationIndicatorsStrategy extends AbstractCollectionStrategy
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
                if ($value instanceof InnovationIndicators) {
                    $attachments = [];
                    foreach ($value->getInnovationIndicatorAttachments() as $attachment) {
                        if ($attachment instanceof InnovationIndicatorAttachments) {
                            $attachments[] = [
                                'uuid'      => $attachment->getUuid(),
                                'filename'  => $attachment->getAttachmentUploadedFilename(),
                                'name'  => $attachment->getName(),
                                'numberOfLetter'  => $attachment->getNumberOfLetter(),
                                'dateOfLetter'  => $attachment->getDateOfLetter()->format('c'),
                                'youtubeUrl'  => $attachment->getYoutubeUrl(),
                                'url'       => $this->baseUrl . '/' . $attachment->getAttachmentSavedFilename(),
                            ];
                        }
                    }

                    $results[] = [
                        'uuid'      => $value->getUuid(),
                        'indicatorName'  => $value->getIndicator()->getIndicatorName(),
                        'indicatorFileType'  => $value->getIndicator()->getIndicatorFileType(),
                        'indicatorFileTypeNote'  => $value->getIndicator()->getIndicatorFileTypeNote(),
                        'innovationIndicatorWeight'  => $value->getInnovationIndicatorWeight(),
                        'innovationIndicatorTemporaryWeight'  => $value->getInnovationIndicatorTemporaryWeight(),
                        'indicatorName'  => $value->getIndicator()->getIndicatorName(),
                        'attachments'  => $attachments,
                        'indicatorParameter'  => $value->getIndicatorParameter() != null ? $value->getIndicatorParameter()->getIndicatorParameterName() : '-',
                    ];
                }
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
}
