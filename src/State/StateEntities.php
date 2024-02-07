<?php

namespace App\State;

use App\Entities\Contract\IEntity;

class StateEntities extends StateObjects

    {
        /** @var  IEntity[] $workers*/
        protected array $workers;
        protected IEntity $entity;

        public function createEntity(string $type, string $name): void
        {
            /** @var IEntity $worker */
            $worker = new $type();
            $worker->setName($name);
            $this->workers[] = $worker;
        }

        public function getWorkersList(): array
        {
            return $this->workers;
        }

        public function getWorkerByType(string $type): ?IEntity
        {
            return $this->getWorkersList()[$type] ?? null;
        }
    }