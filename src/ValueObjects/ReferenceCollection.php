<?php

namespace ReviewPack\ValueObjects;

/**
 * Class ReferenceCollection
 * @package ReviewPack\ValueObjects
 */
class ReferenceCollection
{

    /**
     * @var mixed
     */
    private array $references = [];

    /**
     * Construct the collection, enter up to 5 custom strings by using the splat operator.
     *
     * @param string ...$references
     */
    public function __construct(string ...$references)
    {
        $this->references = $references;
    }

    /**
     * @return mixed
     */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * @return mixed|null
     */
    public function getFirstReference(): ?string
    {
        return $this->getReferenceByKey(0);
    }

    /**
     * @return mixed|null
     */
    public function getSecondReference(): ?string
    {
        return $this->getReferenceByKey(1);
    }

    /**
     * @return mixed|null
     */
    public function getThirdReference(): ?string
    {
        return $this->getReferenceByKey(2);
    }

    /**
     * @return mixed|null
     */
    public function getFourthReference(): ?string
    {
        return $this->getReferenceByKey(3);
    }

    /**
     * @return mixed|null
     */
    public function getFifthReference(): ?string
    {
        return $this->getReferenceByKey(4);
    }

    /**
     * @param int $key
     * @return mixed|null
     */
    private function getReferenceByKey(int $key): ?string
    {
        if (isset($this->references[$key])) {
            return (string)$this->references[$key];
        }

        return null;
    }

}